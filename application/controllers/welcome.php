<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('datacontrol');
	}
	public function index()
	{
		$this->load->view('testform');
	}
	public function galleryshow()
	{
		$data['list'] = $this->datacontrol->getimages();
		 $this->load->view('gallery',$data);
		
	}
	public function create()
	{
		$this->datacontrol->createtable();
		echo "table altered";
	}
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		// $config['max_size']	= '1000';
		// $config['max_width']  = '1024';
		// $config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('image'))
		{
			$error = array('error' => $this->upload->display_errors());

			print_r($error);
		}
		else
		{
			$data = $this->upload->data();
			$file_name = $data['file_name'];

			$myarray = array('imagename' => $file_name);
			$this->db->insert('images',$myarray);
			echo "image uploaded successfully";
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */