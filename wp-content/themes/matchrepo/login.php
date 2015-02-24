<?

/*
Template Name: התחברות
*/

use Matchrepo\QueryResponse;

$blog_name = get_bloginfo();

if ($_POST) {

    $errorMsg = [];

    $user = wp_signon();

    if (is_wp_error($user)) {

        foreach ($user->errors as $error)
            $errorMsg[] = $error[0];
    } else {

        wp_redirect(get_permalink(get_page_by_title('החשבון שלי')));

        exit;
    }

    $errorMsg = array_map(function ($error) {
        return ['type' => 'error', 'label' => $error];
    }, $errorMsg);

    $errorMsg = QueryResponse::prepareList($errorMsg);
}

Matchrepo::mainFormHeader();

Matchrepo::loginHeader();

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div id="main-form-background">
                <h2 id="main-title">התחברות</h2>

                <div id="login-wrapper">
                    <? if (!empty($errorMsg)) { ?>
                        <div id="response-error" class="query-response"><?= $errorMsg ?></div>
                    <? } ?>
                    <form id="login" method="post">
                        <label for="username">שם משתמש</label>
                        <input type="text" id="username" name="log" value="<?= @$_POST['log'] ?>" required>

                        <label for="password">סיסמה</label>
                        <input type="password" id="password" name="pwd" required>
                        <button>התחברות</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

<? get_sidebar() ?>
<? get_footer() ?>