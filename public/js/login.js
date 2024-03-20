$(function () {
  //クリックすると一定時間いいねを押せないようにする（ダブルクリック対策）
  function stop_process(click_execution) {
    click_execution.css('pointer-events', 'none');
    setTimeout(function () {
      click_execution.css('pointer-events', '');
    }, 500);
  }

  //詳細、一覧画面掲示板投稿のいいね処理
  $('.post_favorite_key').on('click', function () {
    var post_id = $(this).attr("post_id");
    var post_favorite_id = $(this).attr("post_favorite_id");
    var click_post_favorite = $(this);

    stop_process(click_post_favorite);

    $.ajax({
      headers: {//Ajaxを書くときのおまじない。書いておくんだなーくらいの認識でOK
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/post_favorite',// /post_favoriteというURLに飛んだときPHP側の処理
      type: 'post',//　post処理
      data: {// PHP側に送るデータ
        'post_id': post_id, 'post_favorite_id': post_favorite_id, },
    })//一度、web.phpからコントローラーで処理されて返ってくる。

      .done(function (data) {//通信成功
        //　受け取った投稿の数をカウントしなおす
        $('#post_favorite_count' + post_id).text(data[1]).change();

        if (data[0] == 0) {
          click_post_favorite.attr('post_favorite_id', '1');
          click_post_favorite.children().attr('class', 'fas fa-heart');
        }
        if (data[0] == 1) {
          click_post_favorite.attr('post_favorite_id', '0');
          click_post_favorite.children().attr('class', 'far fa-heart');
        }
      })
      .fail(function (data) {//通信失敗
        alert('いいね処理失敗');
      });
  });

  //コメントのいいね処理
  $('.post_comment_favorite_key').on('click', function () {
    var post_comment_id = $(this).attr("post_comment_id");
    var post_comment_favorite_id = $(this).attr("post_comment_favorite_id");
    var click_post_comment_favorite = $(this);

    stop_process(click_post_comment_favorite);

    $.ajax({
      headers: {//Ajaxを書くときのおまじない。書いておくんだなーくらいの認識でOK
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '/post_comment_favorite',// /post_favoriteというURLに飛んだときPHP側の処理
      type: 'post',//　post処理
      data: {// PHP側に送るデータ
        'post_comment_id': post_comment_id, 'post_comment_favorite_id': post_comment_favorite_id,
      },
    })//一度、web.phpからコントローラーで処理されて返ってくる。

      .done(function (data) {//通信成功
        //　受け取った投稿の数をカウントしなおす
        $('#post_comment_favorite_count' + post_comment_id).text(data[1]).change();

        if (data[0] == 0) {
          click_post_comment_favorite.attr('post_comment_favorite_id', '1');
          click_post_comment_favorite.children().attr('class', 'fas fa-heart');
        }
        if (data[0] == 1) {
          click_post_comment_favorite.attr('post_comment_favorite_id', '0');
          click_post_comment_favorite.children().attr('class', 'far fa-heart');
        }
      })
      .fail(function (data) {//通信失敗
        alert('いいね処理失敗');
      });
  });

  //カテゴリー選択
  $('#post_sub_category_change').on('change', function () {
    var category_id = $('option:selected').data('category_id');
    var url = '/post/index/' + category_id;
    window.location = url;
  });

//投稿削除モーダル

  // 投稿の編集モーダルを表示する処理 & 渡された変数をモーダルに表示する処理
  $('.cancelModal').on('click', function () {

    $('.js-modal').fadeIn();//編集モーダルを表示させる。

    //属性と値(タイトル)を変数に入れる処理
    var post_created_at = $(this).attr('post_created_at');

    //属性と値(タイトル)を変数に入れる処理
    var post_title = $(this).attr('post_title');

    //属性と値(投稿内容)を変数に入れる処理
    var post_body = $(this).attr('post_body');

    //属性と値(投稿id)を変数に入れる処理
    var post_id = $(this).attr('post_id');


    //モーダルのタイトル部分に既存のタイトルを入れる処理
    $('.modal-inner-created_at span').text(post_created_at);

    //モーダルのタイトル部分に既存のタイトルを入れる処理
    $('.modal-inner-title span').text(post_title);

    //モーダルの投稿部分に既存の投稿内容を入れる処理
    $('.modal-inner-body span').text(post_body);

    //投稿idをhiddenのvalueに入れる処理
    $('.edit-modal-hidden').val(post_id);

    return false;

  });


  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();//モーダルを閉じる
    return false;
  });

  //コメント削除モーダル作成中

  // 投稿の編集モーダルを表示する処理 & 渡された変数をモーダルに表示する処理
  $('.cancelModal').on('click', function () {

    $('.js-modal').fadeIn();//編集モーダルを表示させる。

    //属性と値(コメント作成日時)を変数に入れる処理
    var comment_created_at = $(this).attr('comment_created_at');

    //属性と値(コメント)を変数に入れる処理
    var comment = $(this).attr('comment');

    //属性と値(コメントID)を変数に入れる処理
    var comment_id = $(this).attr('comment_id');

    //モーダルにコメント作成日時埋め込む処理
    $('.modal-inner-created_at span').text(comment_created_at);

    //モーダルにコメントを埋め込む処理
    $('.modal-inner-comment span').text(comment);

    //投稿idをhiddenのvalueに入れる処理（コントローラーに送るために、hiddenで送る）
    $('.edit-modal-hidden').val(post_id);

    return false;

  });


  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();//モーダルを閉じる
    return false;
  });



  // サブカテゴリーアコーディオンメニュー個別展開

  const accordions = document.getElementsByClassName("accordion");//まず、accordionから複数の要素を取り出してaccordionsに収める。

  for (let i = 0; i < accordions.length; i++) {//取り出したaccordionの数だけイベントリスナーを付与していく。
    accordions[i].addEventListener("click", function () {//accordion[0]〜最大数までそれぞれをクリックorホバーした時(hoverはmouseoverに変更する)
      this.classList.toggle("active");//それぞれのリストにactiveクラスをつける。
      const panel = this.nextElementSibling;// panelをaccordionの妹クラスと設定する。
      if (panel.style.maxHeight) {//もしmax-heightが指定していたらmax-heightをnullにする。
        panel.style.maxHeight = null;
      } else {//そうでなければ、max-heightを指定する。scrollHeightは隠れている部分も含めた高さのこと。
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }




});
