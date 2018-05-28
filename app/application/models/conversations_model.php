<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conversations_model extends CI_Model {
// $query = $this->db->query('SELECT C.id, C.sessionId AS sessionId, C.timestamp AS timestamp, C.channel AS channel, (SELECT CONCAT("- ", substring_index(GROUP_CONCAT(resolvedQuery SEPARATOR "<br>- "), "<br>- ", 2)) FROM conversations_detail WHERE id_conversation = C.id AND source = "AGENT") AS conversation FROM conversations C ORDER BY C.timestamp DESC');      
    var $table = 'conversations';
    var $column_order = array(null, 'timestamp','sessionId','channel', 'conversation', null); //set column field database for datatable orderable
    var $column_search = array('timestamp','sessionId','channel'); //set column field database for datatable searchable 
    var $order = array('timestamp' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    private function _get_datatables_query()
    {   
        if(($this->input->post('datetimepicker1')) && ($this->input->post('datetimepicker2')))
        {
            $this->db->where('timestamp BETWEEN "'.$this->input->post('datetimepicker1').'" AND "'.$this->input->post('datetimepicker2').'"');
        }

        //$this->db->select('timestamp, sessionId, channel, getConversations(id) AS conversation');    
        $this->db->select('timestamp, sessionId, channel, id AS conversation');    
        $this->db->from($this->table);            
        $i = 0;
    
        /*foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    //$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                //if(count($this->column_search) - 1 == $i) //last loop
                    //$this->db->group_end(); //close bracket
            }
            $i++;
        }*/
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {            
        /*$fechaInicial=$this->fechaInicial;
        $fechaFinal=$this->fechaFinal;            
            echo $this->fechaInicial;
            echo "string";
        if (isset($fechaInicial) && isset($fechaFinal)) {   
            echo"HOLA MUNDO";         
            //$this->db->where("$timestamp BETWEEN $fechaInicial AND $fechaFinal");
        }*/

        $this->_get_datatables_query();                
        if($_POST['length'] != -1)        
            $this->db->limit($_POST['length'], $_POST['start']);        
        //$this->output->enable_profiler(TRUE);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}
