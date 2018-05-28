<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Respuestas extends CI_Controller {
	var $fechaInicial;
	var $fechaFinal;
	public function __construct()
    {
        parent::__construct();        
        $this->load->model('respuestas_model','respuestas');        
        $this->load->helper('url');
        $this->load->helper('form');
    }
 
	public function index()
	{
			$breadcrumbs = array(
				"@UMG_Bot_AI" => "/home"
			);

			$page_nav = array(
				"blank" => array(
					"title" => "Respuestas",
					"icon" => "fa-home"
				)
			);
			
			
			$page_nav["blank"]["active"] = true;
			$page_nav["tables"]["sub"]["data"]["active"] = true;

			$page_title = "Respuestas";
			$page_css = array();
			$page_css[] = "your_style.css";
			$no_main_header = false;
			$page_body_prop = array();
			$page_html_prop = array();

			$data['breadcrumbs'] = $breadcrumbs;
			$data['page_nav'] = $page_nav;
			$data['page_title'] = $page_title;
			$data['page_css'] = $page_css;
			$data['no_main_header'] = $no_main_header;
			$data['page_body_prop'] = $page_body_prop;
			$data['page_html_prop'] = $page_html_prop;

			$this->load->database();
			$this->load->view('header', $data);
			$this->load->view('nav');
			$this->load->view('ribbon', $data);
			$this->load->view('respuestas', $data);
			$this->load->view('footer');
			$this->load->view('scripts');
			$this->load->view('respuestas_scripts');
			$this->load->view('google-analytics');
		//}
		//echo("<script>console.log('PHP: Carga de página inicial');</script>");
	}

	public function ajax_list()
	{			
	
		$list = $this->respuestas->get_datatables();		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $respuesta) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $respuesta->timestamp;
			$row[] = $respuesta->sessionId;			
			$row[] = $respuesta->channel;						
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->respuestas->count_all(),
						"recordsFiltered" => $this->respuestas->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
}