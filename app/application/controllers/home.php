<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	var $fechaInicial;
	var $fechaFinal;
	public function __construct()
    {
        parent::__construct();
        $this->load->model('conversations_model','conversaciones');        
        $this->load->helper('url');
        $this->load->helper('form');
    }
 
	public function index()
	{
		/*
		if(!empty($_POST)){
			/*
			$this->fechaInicial = $_POST["startDate"];
			$this->fechaFinal = $_POST["enDate"];			
			*/
			// $this->load->database();
			/*$breadcrumbs = array(
				"ChatbotHero" => "/home"
			);

			$page_nav = array(
				"blank" => array(
					"title" => "Conversaciones",
					"icon" => "fa-home"
				)
			);
			
			
			$page_nav["blank"]["active"] = true;
			$page_nav["tables"]["sub"]["data"]["active"] = true;

			$page_title = "Conversaciones";
			$page_css = array();
			$page_css[] = "your_style.css";
			$no_main_header = false;
			$page_body_prop = array();
			$page_html_prop = array();


			
			// $query = $this->db->query('SELECT C.id, C.sessionId AS sessionId, C.timestamp AS timestamp, C.channel AS channel, (SELECT CONCAT("- ", substring_index(GROUP_CONCAT(resolvedQuery SEPARATOR "<br>- "), "<br>- ", 2)) FROM conversations_detail WHERE id_conversation = C.id AND source = "AGENT") AS conversation FROM conversations C ORDER BY C.timestamp DESC');		

			// $conversaciones = $query->result();
			// $data['conversaciones'] = $conversaciones;
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
			$this->load->view('conversaciones', $data);
			$this->load->view('footer');
			$this->load->view('scripts');
			$this->load->view('conversaciones_scripts');
			$this->load->view('google-analytics');

		}
		else
		{*/
			// $this->load->database();
			$breadcrumbs = array(
				"@UMG_Bot_AI" => "/home"
			);

			$page_nav = array(
				"blank" => array(
					"title" => "Conversaciones",
					"icon" => "fa-home"
				)
			);
			
			
			$page_nav["blank"]["active"] = true;
			$page_nav["tables"]["sub"]["data"]["active"] = true;

			$page_title = "Conversaciones";
			$page_css = array();
			$page_css[] = "your_style.css";
			$no_main_header = false;
			$page_body_prop = array();
			$page_html_prop = array();


			
			// $query = $this->db->query('SELECT C.id, C.sessionId AS sessionId, C.timestamp AS timestamp, C.channel AS channel, (SELECT CONCAT("- ", substring_index(GROUP_CONCAT(resolvedQuery SEPARATOR "<br>- "), "<br>- ", 2)) FROM conversations_detail WHERE id_conversation = C.id AND source = "AGENT") AS conversation FROM conversations C ORDER BY C.timestamp DESC');		

			// $conversaciones = $query->result();
			// $data['conversaciones'] = $conversaciones;
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
			$this->load->view('conversaciones', $data);
			$this->load->view('footer');
			$this->load->view('scripts');
			$this->load->view('conversaciones_scripts');
			$this->load->view('google-analytics');
		//}
		//echo("<script>console.log('PHP: Carga de página inicial');</script>");
	}

	public function ajax_list()
	{			
		/*
		echo $this->fechaInicial;
		echo $this->fechaFinal;*/
		$list = $this->conversaciones->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $conversacion) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $conversacion->timestamp;
			$row[] = $conversacion->sessionId;			
			$row[] = $conversacion->channel;
			$row[] = $conversacion->conversation;
			$row[] = '<center><i class="fa fa-eye" aria-hidden="true"></i></center>';
			//$row[] = $customers->country;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->conversaciones->count_all(),
						"recordsFiltered" => $this->conversaciones->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function conversation()
	{
		$this->load->database();
		$sessionId = isset($_GET['sessionId']) ? $_GET['sessionId'] : null ;							
		$query = $this->db->query('SELECT id FROM conversations WHERE sessionId="'.$sessionId.'" LIMIT 1');		
		foreach ($query->result() as $row)
		{
			$id_conversation = $row->id;			
		}
		$query2 = $this->db->query('SELECT * FROM conversations_detail WHERE id_conversation="'.$id_conversation.'"');		
		$data['detalle_conversacion'] = $query2->result();
		$this->load->view('view_conversation', $data);		
	}	
}