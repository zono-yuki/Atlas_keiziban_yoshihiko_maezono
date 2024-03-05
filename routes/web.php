<?php
//ログアウト中のページ(ログアウトしている人しか見れない)
Route::group(['middleware' => ['guest']], function (){
    //ログイン関連の処理
    Route::namespace('Auth')->group(function (){
        Route::namespace('login')->group(function (){
            //ログイン画面を表示する
            Route::get('/login','LoginController@loginForm')->name('login.form');
            //ログイン処理(トップページへ遷移させる)
            Route::post('/login', 'LoginController@login')->name('login');
        });
        Route::namespace('Register')->group(function () {
            //ユーザー登録画面
            Route::get('/register/form', 'RegisterController@registerForm')->name('register.form');
            //ユーザー登録処理
            Route::post('/register', 'RegisterController@register')->name('register');
            //ユーザー登録完了画面
            Route::get('/register/added', 'RegisterController@registerAdded')->name('register.added');
        });
    });
});


//ログイン中のページ
Route::group(['middleware' => ['auth']], function(){
    //管理者専用の処理
    Route::group(['middleware' => ['can:admin']], function(){
        Route::namespace('Admin')->group(function(){
            //掲示板関連の処理
            Route::namespace('Post')->group(function(){
                //カテゴリー一覧画面
                Route::get('/post_category', 'PostsController@postCategoryIndex')->name('post_category.index');

                //追加 メインカテゴリー登録完了画面へ
                Route::get('/main_category_add_ok', 'PostMainCategoriesController@MainCategoryAdded')->name('main_category_add');

                //追加 サブカテゴリー登録完了画面へ
                Route::get('/sub_category_add_ok', 'PostSubCategoriesController@SubCategoryAdded')->name('sub_category_add');

                //新規メインカテゴリー登録処理
                Route::post('/main_store','PostMainCategoriesController@store')->name('main_store');

                //メインカテゴリー削除処理
                Route::resource('post_main_category', 'PostMainCategoriesController', ['only' => ['destroy']]);

                // 新規サブカテゴリー登録処理、サブカテゴリー削除処理  ※ブレードでは、{{ route('post_sub_category.store') }}のようにする
                Route::resource('post_sub_category', 'PostSubCategoriesController', ['only' => ['store', 'destroy']]);

            });
        });
    });

    //ユーザー、管理者共通の処理
    Route::group(['middleware' => ['can:user']], function(){
        Route::namespace('Auth')->group(function(){
            //ログイン関連の処理
            Route::namespace('Login')->group(function(){
                //ログアウトの処理
                Route::get('/logout', 'LoginController@logout')->name('logout');
            });
        });

        //掲示板関連の処理
        Route::namespace('User')->group(function(){
            Route::namespace('Post')->group(function(){

                //掲示板一覧ページ表示
                Route::get('/post/index/{category?}', 'PostsController@index')->name('post.index');

                //掲示板投稿処理、編集画面表示、編集処理、削除処理
                Route::resource('post','PostsController',['only' => ['create','store','edit','update','destroy']]);

                //view数カウント
                Route::group(['middleware' => ['post.show']], function(){
                //投稿詳細画面表示
                Route::get('/post/{post}', 'PostsController@show')->name('post.show');
                });

                //掲示板コメント投稿処理
                Route::post('/post_comment/{post_comment}', 'PostCommentsController@store')->name('post_comment.store');

                //掲示板コメント投稿処理、編集画面表示、編集処理、削除処理
                Route::resource('post_comment', 'PostCommentsController', ['only' => ['edit', 'update', 'destroy']]);

                //掲示板投稿のコメントのいいね処理
                Route::post('/post_favorite', 'PostFavoritesController@postFavorite')->name('post_favorite');

                //掲示板投稿のコメントのいいね処理
                Route::post('/post_comment_favorite', 'PostCommentFavoritesController@postCommentFavorite')->name('post_comment_favorite');
            });
        });


    });
});
