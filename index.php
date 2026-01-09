<?php
/*
Plugin Name: Plugin Vanzox3
Description: Plugin de cadastro de usuários para treino
Author: Victor Villela
Text Domain: cadastro_usuarios
*/

if (!defined('ABSPATH')) {
    exit;
}

/* =====================================================
   ATIVAÇÃO – CRIA TABELA
===================================================== */
function vt_ativar_plugin() {
    global $wpdb;

    $table = $wpdb->prefix . 'palhacada';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        nome VARCHAR(50) NOT NULL,
        sobrenome VARCHAR(50) NOT NULL,
        sexo VARCHAR(10) NOT NULL,
        datanasc DATE NOT NULL,
        email VARCHAR(100) NOT NULL,
        telefone VARCHAR(20),
        endereco VARCHAR(100),
        cidade VARCHAR(50),
        estado VARCHAR(2),
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'vt_ativar_plugin');

/* =====================================================
   MENU ADMIN
===================================================== */
function vt_menu_admin() {
    add_menu_page(
        'Cadastro',
        'Cadastro',
        'manage_options',
        'cadastro-usuarios',
        'vt_pagina_admin',
        'dashicons-id',
        5
    );
}
add_action('admin_menu', 'vt_menu_admin');

/* =====================================================
   PROCESSA FORMULÁRIO
===================================================== */
function vt_processa_cadastro() {
    if (!current_user_can('manage_options')) {
        wp_die('Permissão negada');
    }

    global $wpdb;
    $table = $wpdb->prefix . 'palhacada';

    $dados = [
        'nome'      => sanitize_text_field($_POST['nome']),
        'sobrenome' => sanitize_text_field($_POST['sobrenome']),
        'sexo'      => sanitize_text_field($_POST['sexo']),
        'datanasc'  => sanitize_text_field($_POST['data_nascimento']),
        'email'     => sanitize_email($_POST['email']),
        'telefone'  => sanitize_text_field($_POST['telefone']),
        'endereco'  => sanitize_text_field($_POST['residencia']),
        'cidade'    => sanitize_text_field($_POST['cidade']),
        'estado'    => sanitize_text_field($_POST['estado']),
    ];

    $email_existe = $wpdb->get_var(
        $wpdb->prepare("SELECT email FROM $table WHERE email = %s", $dados['email'])
    );

    if ($email_existe) {
        wp_redirect(admin_url('admin.php?page=cadastro-usuarios&erro=email'));
        exit;
    }

    $wpdb->insert($table, $dados);

    wp_redirect(admin_url('admin.php?page=cadastro-usuarios&sucesso=1'));
    exit;
}
add_action('admin_post_vt_cadastro', 'vt_processa_cadastro');

/* =====================================================
   PÁGINA ADMIN
===================================================== */
function vt_pagina_admin() {
?>
<h1>Cadastro de Usuários</h1>

<form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
    <input type="hidden" name="action" value="vt_cadastro">

    <input type="text" name="nome" placeholder="Nome" required><br><br>
    <input type="text" name="sobrenome" placeholder="Sobrenome" required><br><br>

    <label><input type="radio" name="sexo" value="Masculino" required> Masculino</label>
    <label><input type="radio" name="sexo" value="Feminino"> Feminino</label><br><br>

    <input type="date" name="data_nascimento" required><br><br>
    <input type="email" name="email" placeholder="E-mail" required><br><br>
    <input type="text" name="telefone" placeholder="Telefone"><br><br>
    <input type="text" name="residencia" placeholder="Endereço"><br><br>
    <input type="text" name="cidade" placeholder="Cidade"><br><br>

    <select name="estado">
        <option value="">Estado</option>
        <option value="SP">SP</option>
        <option value="RJ">RJ</option>
    </select><br><br>

    <button type="submit">Cadastrar</button>
</form>
<?php
}

/* =====================================================
   SHORTCODE
===================================================== */
function vt_lista_usuarios() {
    global $wpdb;
    $table = $wpdb->prefix . 'palhacada';
    $users = $wpdb->get_results("SELECT * FROM $table");

    ob_start();
    echo '<table border="1"><tr><th>Nome</th><th>Email</th><th>Cidade</th></tr>';
    foreach ($users as $u) {
        echo "<tr><td>{$u->nome}</td><td>{$u->email}</td><td>{$u->cidade}</td></tr>";
    }
    echo '</table>';
    return ob_get_clean();
}
add_shortcode('login_auth_form', 'vt_lista_usuarios');
