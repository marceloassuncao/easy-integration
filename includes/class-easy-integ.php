<?php

if (!defined('ABSPATH')):
    exit();
endif;

if (!class_exists('easyIntegClass')):
    class easyIntegClass
    {
        public function __construct()
        {
            add_action('admin_menu', array($this, 'esi_init'));

            add_action('wp_ajax_esi_async_request', array(
                $this,
                esi_async_request
            ));
        }

        public function esi_init()
        {
            add_menu_page(
                'Integração',
                'Integração',
                'manage_options',
                'esi-page',
                array($this, 'esi_menu_page_callback'),
                'dashicons-welcome-widgets-menus',
                90
            );
        }

        public function esi_menu_page_callback()
        {
            ?>
                <section class="esi-container">
                    <button class="esi-btn">Iniciar</button>
                </section>
            <?php
        }

        public function esi_async_request()
        {
            if (
                !isset($_POST['action']) ||
                $_POST['action'] !== 'esi_async_request'
            ):
                echo json_encode(array(
                    'status' => 'error'
                ));
                wp_die();
            endif;

            do_action('esi_start_integration');

            echo json_encode(array(
                'status' => 'success'
            ));
            wp_die();
        }
    }
    $easyIntegClass = new easyIntegClass();
endif;
