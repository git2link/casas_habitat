<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Usuario extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('concat(nombre, " ", apellido_paterno, " ", apellido_materno) as unuario_nombre,
            usuario.* , perfil.name as perfil_name', false);
        $this->db->from('usuario');
        $this->db->join('perfil', 'usuario.perfil_id = perfil.id', 'left');
        $this->db->where('usuario.activo', 1);

        $query = $this->db->get();
        return $query->result();
    }

    function allFiltered($field, $value) {
        $this->db->select('usuario.* , perfil.name as perfil_name');
        $this->db->from('usuario');
        $this->db->join('perfil', 'usuario.perfil_id = perfil.id', 'left');
        $this->db->like($field, $value);

        $query = $this->db->get();
        return $query->result();
    }

    function usuario_foto_exist($usuario_k) {
        $this->db->select('usuario_foto_k');
        $this->db->from('usuario_foto');
        $this->db->where('usuario_k', $usuario_k);
        $query = $this->db->get();
        return $query->result();
    }

    function insert_usuario_foto($registro) {
        $this->db->set($registro);
        $this->db->insert('usuario_foto');
    }

    function update_usuario_foto($registro) {
        $this->db->set($registro);
        $this->db->where('usuario_foto_k', $registro['usuario_foto_k']);
        $this->db->update('usuario_foto');
    }

    function find($id) {
    	$this->db->where('id', $id);
		return $this->db->get('usuario')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('usuario');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('id', $registro['id']);
		$this->db->update('usuario');
    }

    function delete($id) {
    	$this->db->where('id', $id);
		$this->db->delete('usuario');
    }

    function get_login($user, $pass) {

        $where = array(
            'login'     => $user,
            'password'  => $pass
            );

        $this->db->select( 'u.* , uf.foto');
        $this->db->from('usuario u');
        $this->db->join('usuario_foto uf' , 'uf.usuario_k = u.id' , 'left');
        $this->db->where( $where );

        return $this->db->get();

    }

    function get_perfiles() {
        $lista = array();
        $this->load->model('Model_Perfil');
        $registros = $this->Model_Perfil->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->name;
        }
        return $lista;
    }

    function get_perfil_list() {
        $this->db->select('*', false);
        $this->db->from('perfil');
        $query = $this->db->get();
        return $query->result();
    }

    function find_json( $id ){

        $this->db->select('*');
        $this->db->from('cliente');
        $this->db->where('cliente_k' , $id );

        $data = $this->db->get();

        return $data->row();
    }

    function get_foto( $usuario_k ){

        $where = array(
            'usuario_k' => $usuario_k
            );

        $this->db->select('foto');
        $this->db->from('usuario_foto');
        $this->db->where( $where );

        $data = $this->db->get()->row();

        $foto = (empty ($data->foto)) ? base_url('../img/avatars/avatar_default.png') : $data->foto;
        
        return $foto;

    }

}
