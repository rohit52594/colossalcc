<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seller_auth extends CI_Model {

    public function checkLogin($phone, $password, $operatingSystem, $browser) {

        $this->db->where('phone', $phone);

        $query = $this->db->get('seller');

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $key) {

                $decPassword = $this->encryption->decrypt($key->password);

                if ($decPassword == $password) {

                    if ($key->is_active == 1) {

                        $loginData = [

                            'user_id' => $key->id,

                            'user_role' => 'SELLER',

                            'os' => $operatingSystem,

                            'browser' => $browser,

                            'ip' => $_SERVER['REMOTE_ADDR'],

                            'login_date' => date('Y-m-d'),

                            'login_time' => date('H:i:s')


                        ];

                        $this->db->insert('login_history', $loginData);

                        $this->session->set_userdata('id', $key->id);

                        $this->session->set_userdata('email', $key->email);

                        $this->session->set_userdata('role', 'SELLER');

                        $this->session->set_userdata('name', $key->name);

                    } else {

                        return "Account is not active, please contact administrator";

                    }

                } else {

                    return 'Incorrect password';

                }

            }

        } else {

            return "Wrong phone number";

        }

    }

}

?>