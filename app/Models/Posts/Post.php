<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];

    //Userとのリレーション
    public function user()
    {
        //多対1の（多側からみたリレーション）
        return $this->belongsTo('App\Models\Users\User', 'user_id');
    }

    //PostSubCategoryとのリレーション
    public function postSubCategory()
    {
        //多対1の（多側からみたリレーション）
        return $this->belongsTo('App\Models\Posts\PostSubCategory', 'post_sub_category_id');
    }

    //PostCommentとのリレーション
    public function postComments()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    //ActionLogとのリレーション
    public function actionLogs()
    {
        return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }

    //Userとのリレーション（多対多）
    public function userPostFavoriteRelations()
    {
        return $this->belongsToMany('App\Models\Users\User', 'post_favorites', 'post_id' , 'user_id');
    }

    //掲示板の投稿のいいね登録、削除処理
    public static function postFavoriteCreateOrDestroy($post_id, $post_favorite_id)
    {
        $post_detail = self::findOrFail($post_id);
        if($post_favorite_id){
            return $post_detail->userPostFavoriteRelations()->detach(Auth::id());//中間テーブルのレコード削除
        } else{
            return $post_detail->userPostFavoriteRelations()->attach(Auth::id());//中間テーブルのレコード登録
        }
    }

    //　投稿に対してログインしているユーザーがいいねしているかどうかの判断（nullだったらtrueを返す)
    public static function postFavoriteIsExistence($post_detail)
    {
        return is_null($post_detail->userPostFavoriteRelations->find(Auth::id()));
    }

//----------------------------------------------------
    //クエリ作成（N＋1対策）
    public static function postQuery()
    {
        return self::with([//全投稿取得、リレーション先も取得する
            //リレーション名を書く。
            'user',
            'userPostFavoriteRelations',
            'postSubCategory',
            'postComments.user',
            'actionLogs'
            //postCommentsのuserメソッドとのリレーションで、postテーブルのuser_idと同じユーザーをuserからもってくる
        ]);
    }

    //投稿idから投稿データを1つ取得する
    public static function postDetail($id)
    {
        return self::postQuery()->findOrFail($id);
    }
    // ---------------------------------------------------
    //投稿一覧を表示
    public static function postLists($request, $category_id, $post_sub_category_id)
    {
        $keyword = $request->keyword;
        $post_lists = self::postQuery();//全投稿&リレーション先を取得する
        $post_favorite = $request->post_favorite;
        $post_mine = $request->post_mine;
        $post_sub_category_id = $request->post_sub_category_id;
        // dd($post_sub_category_id);ok

        //カテゴリーを選択した時の処理（サブカテゴリーから検索）
        if($category_id){
            $post_lists = $post_lists->where('post_sub_category_id', $category_id);
        }

        //キーワード検索した時の処理
        if($keyword){//もし、キーワードがあったら、
            $post_lists = $post_lists
            ->where('title', 'like', '%' . $keyword . '%')//タイトルにキーワードが入っているか
            ->orWhere('post', 'like', '%' . $keyword . '%')//または投稿にキーワードが入っているか
            ->orWhereIn('post_sub_category_id', function ($query) use($keyword){
                $query->from('post_sub_categories')//サブカテゴリーテーブルを使用
                ->select('id')//選択するサブカテゴリーid
                ->where('sub_category', $keyword);
            });//投稿テーブルの「投稿サブカテゴリーid」が、、サブカテゴリーテーブルのキーワードと一致するサブカテゴリー名の、サブカテゴリーidを比べて同じだったら、（そのカテゴリーがあったら）みたいなかんじ。（orwhereInは、リレーション先の他のテーブルも使う時に使う。）
        }

        //いいねした投稿一覧を押した時の処理
        if($post_favorite){
            $post_lists = $post_lists
            ->orWhereIn('id', function($query){
                $query->from('post_favorites')
                    ->select('post_id')
                    ->where('user_id', Auth::id());
            });//リレーション先の中間テーブルから引用してくる
        }

        //自分の投稿を検索する処理
        if($post_mine){
            $post_mine = $post_lists->where('user_id', Auth::id());
        }

        if($post_sub_category_id){
            $post_lists = Post::where('post_sub_category_id', $post_sub_category_id);
        }

    return $post_lists->get();
    }

    // ---------------------------------------------------

    //投稿の更新処理
    public static function postUpdate($request, $post_detail)
    {
        $data['post_sub_category_id'] = $request->post_sub_category_id;
        $data['title'] = $request->title;
        $data['post'] = $request->post;
        return $post_detail->fill($data)->save();
    }

    //投稿の削除
    public static function postDestroy($id)
    {
        // 投稿を探す処理
        $post = Post::findOrFail($id);
        // 投稿の削除
        $post->delete();
    }

    //投稿に対してのコメントがあるかどうかの判断(nullならtrueを返す)
    public static function postCommentIsExistence($post_detail)
    {
        return $post_detail -> postComments ->isEmpty();
    }

}
