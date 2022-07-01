<?php


/*
Plugin Name: Pluguin_vanzox3
Description: Um pluguin para treino
Author: Victor Villela
Author URI: Vitu.com
Text Domain: cadastro_usuarios
*/


  // Setup
//registrando uma variavel para executal em outros lugares
define('REGISTRO_PLUGUIN_URL', __FILE__);


//criaçao da tabela
  global $wpdb;
    $table_name = $wpdb->prefix . 'palhacada';
    $wpdb_collate = $wpdb->collate;
    $sql ="CREATE TABLE {$table_name} (
    id BIGINT(20) NOT NULL AUTO_INCREMENT,
    nome VARCHAR(32) NOT NULL,
    sobrenome VARCHAR(32) NOT NULL,
    sexo VARCHAR(10) NOT NULL,
    datanasc DATE(10) NOT NULL,
    email TEXT(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    endereco VARCHAR(50) NOT NULL,
    cidade VARCHAR(32) NOT NULL,
    estado VARCHAR(10) NOT NULL,
    PRIMARY KEY (id)) ". $wpdb->get_charset_collate();
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta( $sql );



  




//------------------------------------------------------------------------------------------------------------------------------------------------//





	function vt_activate_plugin() {
    if(version_compare(get_bloginfo('version'), '5.0', '<')){
        wp_die(__('Você precisa atualizar seu wordpress para usar esse plugin', 'cadastro-empresas'));



        if(!function_exists('add_action')){
    echo __('Opa! Eu sou só um plugin, não posso ser chamado diretamente!', 'cadastro-empresas');
    exit;
					}
			}

}


function carregar_js_css(){
 wp_register_script( "js", WP_PLUGIN_URL.'/my_voter_script.js', array('jquery') );
	wp_enqueue_script('js',plugins_url('/my_voter_script.js',__FILE__), array ('jquery'), '1.0',true);
	wp_enqueue_script( 'my_voter_script' );
}
add_action('wp_enqueue_scripts','carregar_js_css');



//------------------------------------------------------------------------------------------------------------------------------------------------//







//------------------------------------------------------------------------------------------------------------------------------------------------//

function cadastro_usuario_plugin(){
	if(isset($_POST['submit'])){

		global $wpdb;
		
    		$table_name = $wpdb->prefix . 'palhacada';
			$nome = sanitize_text_field($_POST['nome']); 
			$snome = sanitize_text_field($_POST['sobrenome']); 
			$sexo = sanitize_text_field($_POST['sexo']); 
			$data_nascimento = sanitize_text_field($_POST['data_nascimento']); 
			$email = sanitize_email($_POST['email']); 
			$telefone = sanitize_text_field($_POST['telefone']); 
			$residencia = sanitize_text_field($_POST['residencia']); 
			$cidade = sanitize_text_field($_POST['cidade']); 
			$estado = sanitize_text_field($_POST['estado']);




			//
    


//verificando email ja no banco
$datum = $wpdb->get_results("SELECT * FROM $table_name WHERE email= '".$email."'");
if($wpdb->num_rows > 0) {
print"<script> alert('Email já cadastrado! Refaça o cadastro com outro email.');</script>";
print "<script> location.href='admin.php?page=cadatro-de-usuarios';</script>";
}
// se não existir o email então isere os dados no banco
else{

			$wpdb-> insert($table_name , array(
				'nome' => $nome,
				'sobrenome' => $snome,
				'sexo' => $sexo,
				'datanasc' => $data_nascimento,
				'email' => $email,
				'telefone' => $telefone,
				'endereco' => $residencia,
				'cidade' => $cidade,
				'estado' => $estado,
			));

}
$wpdb->show_errors(); 

// se ocorreu tudo bem  mandar uma mensagem de sucess.
		if($wpdb ==true){
			print"<script> alert('Cadastrado com Sucesso');</script>";
		print "<script> location.href='admin.php?page=cadatro-de-usuarios';</script>";
}
	//else{
		//print"<script> alert('não foi possivel');</script>";
		//print "<script> location.href='admin.php?page=cadatro-de-usuarios';</script>";
	//}

//header("location: admin.php?page=cadatro-de-usuarios");
//exit;




    //var_dump($_POST['email']);
	}
}
add_action('admin_post_cadastro_usuario_plugin', 'cadastro_usuario_plugin');

//------------------------------------------------------------------------------------------------------------------------------------------------//


//criando o menu no adm page
	function admin_posts_notification_menu_item()

{

    add_menu_page(

        __('Cadastro', 'cadastro-de-usuarios'),

        __('Cadastro', 'cadastro-de-usuarios'),


       //quem vai poder acessar (wproles)

        'publish_pages',

        'cadatro-de-usuarios',

        'admin_page_content',

//icone do menu existe diversos
        'dashicons-schedule',
//ordem de aparecer menu
        3

    );

}
	add_action('admin_menu', 'admin_posts_notification_menu_item');


//------------------------------------------------------------------------------------------------------------------------------------------------//
		
function admin_page_content(){
//Formulario para cadastro
	?>
	
	<h1>Formulário Teste</h1>
	<div id= "cadastro_aviso"> </div>
	<form  action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" id=cadastro_usuarios>
            <input type="hidden" name="action" value="cadastro_usuario_plugin">
	<fieldset class="grupo">
		<div class="campo">
			<label for="nome">Nome</label>
			<input type="text" id="nome" name="nome" placeholder="nome" required  style="width: 20em" value="" />
		</div>
		<div class="campo">
			<label for="snome">Sobrenome</label>
			<input type="text" id="snome" name="sobrenome" placeholder="Sobrenome" required style="width: 20em" value="" />
		</div>
	</fieldset>	
	<br>
	<div class="campo">
		<label>Sexo</label>
		<label class="checkbox">
			<input type="radio" name="sexo"  value="masculino" required> Masculino
		</label>
		<label class="checkbox">
			<input type="radio" name="sexo" value="feminino" required> Feminino
		</label>
		<label class="checkbox">
			<input type="radio" name="sexo" value="outro" required> Outro
		</label>
	</div>
	<br>
	<div class="campo">
		<label for="email">Data de nascimento</label>
		<input type="date" id="date" name="data_nascimento" placeholder="Ano em que Nasceu" required  style="width: 41em" value="" />
	</div>
<br>
	<div class="campo">
		<label for="email">E-mail</label>
		<input type="text" id="email" name="email" placeholder="Seu melhor email" required  style="width: 41em" value="" />
	</div>

<br>
	<div class="campo">
		<label for="telefone">Telefone</label>
		<input type="text" id="telefone" name="telefone" placeholder="Telefone de fácil acesso" required  style="width: 20em"  value="" />
	</div>
	<br>
	<div class="campo">
		<label for="telefone">Endereço</label>
		<input type="text" id="text" name="residencia" placeholder="Onde você reside" required  style="width: 20em"  value="" />
	</div>
	<br>
	<fieldset class="grupo">
		<div class="campo">
			<label for="cidade">Cidade</label>
			<input type="text" id="cidade" name="cidade"placeholder="Cidade onde está localizado" required   style="width: 20em" value="" />
		</div>

		<div class="campo">
			<label for="CEP">CEP</label>
			<input type="text" id="cidade" name="cidadee" placeholder="Seu Código Postal" required  style="width: 20em" value="" />
		</div>

		<div class="campo">
			<label for="estado">Estado</label>
			<select name="estado" id="uf">
					<option value=">--<"/option>
					<option value="AC">AC</option>
				    <option value="AL">AL</option>
				    <option value="AP">AP</option>
				    <option value="AM">AM</option>
				    <option value="BA">BA</option>
				    <option value="CE">CE</option>
				    <option value="DF">DF</option>
				    <option value="ES">ES</option>
				    <option value="GO">GO</option>
				    <option value="MA">MA</option>
				    <option value="MS">MS</option>
				    <option value="MT">MT</option>
				    <option value="MG">MG</option>
				    <option value="PA">PA</option>
				    <option value="PB">PB</option>
				    <option value="PR">PR</option>
				    <option value="PE">PE</option>
				    <option value="PI">PI</option>
				    <option value="RJ">RJ</option>
				    <option value="RN">RN</option>
				    <option value="RS">RS</option>
				    <option value="RO">RO</option>
				    <option value="RR">RR</option>
				    <option value="SC">SC</option>
				    <option value="SP">SP</option>
				    <option value="SE">SE</option>
				    <option value="TO">TO</option>
			</select>
		</div>
	</fieldset>
<br>
	<div class="campo">
		<label>Confirmação</label>
		<label class="checkbox">
			<input type="checkbox" name="newsletter" value="1"> Gostaria de receber email de confirmação de cadastro?
		</label>
	</div>
	
	<button class="botao submit" type="submit" name="submit" id="cadastro_botao">Enviar</button>
    </fieldset>
</form>



<style type="text/css">

#wpadminbar{
    background-color: #333280;
}

* {
    margin: 0;
    padding: 0;
}

fieldset {
    border: 0;
}

body, input, select, textarea, button {
    font-family: sans-serif;
    font-size: 1em;
}

.grupo:before, .grupo:after {
    content: " ";
    display: table;
}

.grupo:after {
    clear: both;
}

.campo {
    margin-bottom: 0,1em;
}

.campo label {
    margin-bottom: 0.2em;
    color: #666;
    display: block;
}

fieldset.grupo .campo {
    float:  left;
    margin-right: 1em;
}

.campo input[type="text"],
.campo input[type="email"],
.campo input[type="url"],
.campo input[type="tel"],
.campo select,
.campo textarea {
    padding: 0.2em;
    border: 1px solid #CCC;
    box-shadow: 2px 2px 2px rgba(0,0,0,0.2);
    display: block;
}

.campo select option {
    padding-right: 1em;
}

.campo input:focus, .campo select:focus, .campo textarea:focus {
    background: #FFC;
}

.campo label.checkbox {
    color: #000;
    display: inline-block;
    margin-right: 1em;
}

.botao {
    font-size: 1.5em;
    background: #333280;
    border: 0;
    margin-bottom: 1em;
    color: #FFF;
    padding: 0.2em 0.6em;
    box-shadow: 2px 2px 2px rgba(0,0,0,0.2);
    text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
}

.botao:hover {
    background: #FB0;
    box-shadow: inset 2px 2px 2px rgba(0,0,0,0.2);
    text-shadow: none;
}

.botao, select, label.checkbox {
    cursor: pointer;
}
.tabela_de_usuarios

background-color: black !important;


</style>

<?php
 

}

// demonstrando o resultado em uma pagina com shortcode
function dl_auth_form_shortcode(){
//$formHTL = file_get_contents(plugins_url('Meupluguintext/template.php'));
//echo $formHTL
?>

<?php
 
global $wpdb;
		//pesquisar cursista x
$table_name = $wpdb->prefix . 'palhacada';
$pesquisar = $_POST['pesquisar'];
$result_cusistas = $wpdb->get_results("select * from {$table_name} WHERE 'nome' LIKE '%pesquisar%'");
//var_dump($result_cusistas);

//echo $resultados['nome'];



    
// echo $formHTL;

//refazer validações via a puxar os dados via ajax

//consiga usar a variavel par acessar bd
    //basico de acessar banco
 global $wpdb;
 $table_name = $wpdb->prefix . 'palhacada';
 $users = $wpdb->get_results("select * from {$table_name}");
 //var_dump($users);

 print("<table class='tabela_de_usuarios'> 
  <tr> 
    <td> Nome: </td> 
    <td> Sobrenome: </td> 
     <td> Sexo: </td> 
      <td> Data de Nascimento: </td> 
       <td> E-mail: </td> 
       <td> Residência: </td> 
       <td> Cidade: </td> 
        <td> Estado: </td> 
  </tr> "); 
 

//para cada usuario fazer alguma coisa
 foreach($users as $user){

    print('
    	<tr>    
        <td>' . $user->nome. '</td> 
        <td>' . $user->sobrenome. '</td> 
        <td>' . $user->sexo. '</td> 
        <td>' . $user->datanasc. '</td> 
        <td>' . $user->email. '</td> 
        <td>' . $user->endereco. '</td> 
        <td>' . $user->cidade. '</td> 
        <td>' . $user->estado. '</td> 
    </tr>');
  //  print($user->display_name);
 }
 print('</table>');
}


add_shortcode('login_auth_form', 'dl_auth_form_shortcode');