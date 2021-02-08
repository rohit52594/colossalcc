<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * 
	 * 
	 */

	public function __construct()
	{

		parent::__construct();

		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('deliverer/Deliverer_auth');
	}

	public function login()
	{
		$this->load->view('deliverer/login/header');
		$this->load->view('deliverer/login/login');
		$this->load->view('deliverer/login/footer');
	}

	public function processLogin()
	{

		$this->form_validation->set_rules('phone', 'Phone', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');

		// $password = $this->encryption->encrypt($this->input->post('password'));

		if ($this->form_validation->run()) {

			$operatingSystem = $this->getOS();

			$browser = $this->getBrowser();

			$result = $this->Deliverer_auth->checkLogin($this->input->post('phone'), $this->input->post('password'), $operatingSystem, $browser);

			if ($result == '') {

				echo "<script>localStorage.setItem('deliverer-access-token', '" . $this->input->post('phone') . "'); window.location.assign('" . base_url('deliverer/dashboard/') . "')</script>";
			} else {

				$this->session->set_flashdata('message', $result);

				redirect('deliverer/authentication/login');
			}
		} else {

			redirect('deliverer/authentication/login');
		}
	}

	public function getOS()
	{

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$os_platform  = "Unknown OS Platform";

		$os_array     = array(
			'/windows nt 10/i'      =>  'Windows 10',
			'/windows nt 6.3/i'     =>  'Windows 8.1',
			'/windows nt 6.2/i'     =>  'Windows 8',
			'/windows nt 6.1/i'     =>  'Windows 7',
			'/windows nt 6.0/i'     =>  'Windows Vista',
			'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			'/windows nt 5.1/i'     =>  'Windows XP',
			'/windows xp/i'         =>  'Windows XP',
			'/windows nt 5.0/i'     =>  'Windows 2000',
			'/windows me/i'         =>  'Windows ME',
			'/win98/i'              =>  'Windows 98',
			'/win95/i'              =>  'Windows 95',
			'/win16/i'              =>  'Windows 3.11',
			'/macintosh|mac os x/i' =>  'Mac OS X',
			'/mac_powerpc/i'        =>  'Mac OS 9',
			'/linux/i'              =>  'Linux',
			'/ubuntu/i'             =>  'Ubuntu',
			'/iphone/i'             =>  'iPhone',
			'/ipod/i'               =>  'iPod',
			'/ipad/i'               =>  'iPad',
			'/android/i'            =>  'Android',
			'/blackberry/i'         =>  'BlackBerry',
			'/webos/i'              =>  'Mobile'
		);

		foreach ($os_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$os_platform = $value;

		return $os_platform;
	}

	public function getBrowser()
	{

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$browser        = "Unknown Browser";

		$browser_array = array(
			'/msie/i'      => 'Internet Explorer',
			'/firefox/i'   => 'Firefox',
			'/safari/i'    => 'Safari',
			'/chrome/i'    => 'Chrome',
			'/edge/i'      => 'Edge',
			'/opera/i'     => 'Opera',
			'/netscape/i'  => 'Netscape',
			'/maxthon/i'   => 'Maxthon',
			'/konqueror/i' => 'Konqueror',
			'/mobile/i'    => 'Handheld Browser'
		);

		foreach ($browser_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$browser = $value;

		return $browser;
	}

	public function passuser()
	{
		extract($_POST);
		if ($token != '0') {
			$reader = $this->Crud->Read('deliverers', " `phone` = '$token'");
			if (isset($reader[0]->id)) {
				foreach ($reader as $key) {
					$name = $key->name;
					$id = $key->id;
					$phone = $key->phone;
					$email = $key->email;
				}

				$data = $this->session->all_userdata();
				foreach ($data as $key => $value) {
					$this->session->unset_userdata($key);
				}

				$this->session->set_userdata('id', $id);

				$this->session->set_userdata('email', $email);

				$this->session->set_userdata('role', 'DELIVERER');

				$this->session->set_userdata('name', $name);
				echo "success";
			}
		}
	}
}
