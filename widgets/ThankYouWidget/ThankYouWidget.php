<?php
namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH')) exit;

class ThankYouWidget extends Widget_Base{

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}
	 
	public function get_style_depends() {
		return [ '' ];
	}
	
	public function get_script_depends() {
		return [ '' ];
	}
	
	public function get_name(){
        return 'thank-you-page';
    }
    
    public function get_title(){
    	return 'Thank you page template';
    }
    
    public function get_icon(){
        return 'fa fa-camera';
    }
    
    public function get_categories(){
        return ['general'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',[
              'label'=>'Settings',
            ]
        );


		$this->add_control(
			'thankyou-success',
			[
				'label' => __( 'Success Shortcode', 'kabacademy' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( '', 'kabacademy' ),
			]
		);

		$this->add_control(
			'thankyou-failed',
			[
				'label' => __( 'Failed Shortcode', 'kabacademy' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( '', 'kabacademy' ),
			]
		);


		$this->end_controls_section();
      }

      protected function render() {
		  $settings = $this->get_settings_for_display();

		  $order = wc_get_order( $_GET['wcf-order'] );


		  if ( $order && $order->has_status( 'failed' ) ) {
			  echo do_shortcode($settings['thankyou-failed']);
          } else {
			  echo do_shortcode($settings['thankyou-success']);
          }

	  }

}