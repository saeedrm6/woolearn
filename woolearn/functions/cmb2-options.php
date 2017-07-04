<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
function woolearn_get_product_option()
{
	$args=array(
		'taxonomy'=>'product_cat',
		'hide_empty'=>false
	);
	$terms=get_terms($args);
	
	$select_items=array();
	foreach($terms as $term){
		$select_items[$term->term_id]=$term->name ;
	}
	return $select_items;
} 
 
 
 
class Woolearn_Admin {
    /**
     * Option key, and option page slug
     * @var string
     */
    private $key = 'woolearn_options';
    /**
     * Options page metabox id
     * @var string
     */
    private $metabox_id = 'woolearn_option_metabox';
    /**
     * Options Page title
     * @var string
     */
    protected $title = '';
    /**
     * Options Page hook
     * @var string
     */
    protected $options_page = '';
    /**
     * Holds an instance of the object
     *
     * @var Woolearn_Admin
     **/
    private static $instance = null;
    /**
     * Constructor
     * @since 0.1.0
     */
    private function __construct() {
        // Set our title
        $this->title = 'تنظیمات قالب';
    }
    /**
     * Returns the running object
     *
     * @return Woolearn_Admin
     **/
    public static function get_instance() {
        if( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->hooks();
        }
        return self::$instance;
    }
    /**
     * Initiate our hooks
     * @since 0.1.0
     */
    public function hooks() {
        add_action( 'admin_init', array( $this, 'init' ) );
        add_action( 'admin_menu', array( $this, 'add_options_page' ) );
        add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
    }
    /**
     * Register our setting to WP
     * @since  0.1.0
     */
    public function init() {
        register_setting( $this->key, $this->key );
    }
    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_options_page() {
        $this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
        // Include CMB CSS in the head to avoid FOUC
        add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
    }
    /**
     * Admin page markup. Mostly handled by CMB2
     * @since  0.1.0
     */
    public function admin_page_display() {
        ?>
        <div class="wrap cmb2-options-page <?php echo $this->key; ?>">
            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
            <?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
        </div>
        <?php
    }
    /**
     * Add the options metabox to the array of metaboxes
     * @since  0.1.0
     */
    function add_options_page_metabox() {
        // hook in our save notices
        add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );
        $cmb = new_cmb2_box( array(
            'id'         => $this->metabox_id,
            'hookup'     => false,
            'cmb_styles' => false,
            'show_on'    => array(
                // These are important, don't remove
                'key'   => 'options-page',
                'value' => array( $this->key, )
            ),
        ) );

        // Set our CMB2 fields

        $group_field_id = $cmb->add_field( array(
            'id'          => 'header_sec',
            'type'        => 'group',
            'repeatable'  => false,
            'options'     => array(
                'group_title'   => 'تنظیمات هدر',
            ),
        ) );

        $cmb->add_group_field( $group_field_id, array(
            'name' => 'متن بالای سایت',
            'id'   => 'top_text',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $group_field_id, array(
            'name' => 'لوگوی سایت',
            'id'   => 'logo',
            'type' => 'file',
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'text'    => array(
                'add_upload_file_text' => 'آپلود فایل' // Change upload button text. Default: "Add or Upload File"
            ),
        ) );


        // social
        $woolearn_social_group = $cmb->add_field( array(
            'id'          => 'woolearn_social_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => false, // use false if you want non-repeatable group
            'options'     => array(
                'group_title'   => "شبکه های اجتماعی",
            ),
        ) );

        $cmb->add_group_field( $woolearn_social_group, array(
            'name' => 'فیسبوک',
            'id'   => 'facebook',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_social_group, array(
            'name' => 'توییتر',
            'id'   => 'twitter',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_social_group, array(
            'name' => 'اینستاگرام',
            'id'   => 'instagram',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_social_group, array(
            'name' => 'تلگرام',
            'id'   => 'telegram',
            'type' => 'text_url',
        ) );


        // index slider

        $cmb->add_field( array(
            'name' => 'اسلایدر صفحه اصلی',
            'type' => 'title',
            'id'   => 'woolearn_slider'
        ) );

        $woolearn_slider_group = $cmb->add_field( array(
            'id'          => 'woolearn_slider_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => "اسلایدر صفحه اصلی {#}",
                'add_button'    => "افزودن اسلایدر جدید",
                'remove_button' => "حذف اسلاید",
                'sortable'      => true, // beta
            ),
        ) );

        $cmb->add_group_field( $woolearn_slider_group, array(
            'name' => 'عنوان',
            'id'   => 'title',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_slider_group, array(
            'name' => 'توضیح',
            'id'   => 'desc',
            'type' => 'textarea_small',
        ) );

        $cmb->add_group_field( $woolearn_slider_group, array(
            'name' => 'متن دکمه راست',
            'id'   => 'first_button',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_slider_group, array(
            'name' => 'لینک دکمه راست',
            'id'   => 'first_button_link',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_slider_group, array(
            'name' => 'متن دکمه چپ',
            'id'   => 'second_button',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_slider_group, array(
            'name' => 'لینک دکمه چپ',
            'id'   => 'second_button_link',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_slider_group, array(
            'name' => 'عکس اسلاید',
            'id'   => 'image',
            'type' => 'file',
            // Optional:
            'options' => array(
                'url' => false, // Hide the text input for the url
				'closed'     => true,
            ),
            'text'    => array(
                'add_upload_file_text' => 'انتخاب عکس' // Change upload button text. Default: "Add or Upload File"
            ),
        ) );



        // index support section

        $cmb->add_field( array(
            'name' => 'بخش سرویس های صفحه اصلی',
            'type' => 'title',
            'id'   => 'woolearn_services'
        ) );

        $woolearn_service_group = $cmb->add_field( array(
            'id'          => 'woolearn_service_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => "آیتم {#}",
                'add_button'    => "افزودن آیتم جدید",
                'remove_button' => "حذف آیتم",
                'sortable'      => true, // beta
            ),
        ) );

        $cmb->add_group_field( $woolearn_service_group, array(
            'name' => 'عنوان',
            'id'   => 'title',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_service_group, array(
            'name' => 'زیرعنوان',
            'id'   => 'subtitle',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_service_group, array(
            'name' => 'نام آیکون',
            'id'   => 'fa_icon',
            'desc' =>'<a target="_balnk" href="http://fontawesome.io/3.2.1/icons/">انتخاب آیکون</a>',
            'type' => 'text',
        ) );



        // index customer section

        $cmb->add_field( array(
            'name' => 'نظر مشتری',
            'type' => 'title',
            'id'   => 'woolearn_customer'
        ) );

        $woolearn_customer_group = $cmb->add_field( array(
            'id'          => 'woolearn_customer_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => "آیتم {#}",
                'add_button'    => "افزودن آیتم جدید",
                'remove_button' => "حذف آیتم",
                'sortable'      => true, // beta
            ),
        ) );

        $cmb->add_group_field( $woolearn_customer_group, array(
            'name' => 'توضیح',
            'id'   => 'desc',
            'type' => 'textarea_small',
        ) );

        $cmb->add_group_field( $woolearn_customer_group, array(
            'name' => 'نام',
            'id'   => 'name',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_customer_group, array(
            'name' => 'عکس',
            'id'   => 'image',
            'type' => 'file',
            // Optional:
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'text'    => array(
                'add_upload_file_text' => 'انتخاب عکس' // Change upload button text. Default: "Add or Upload File"
            ),
        ) );


        // index ads section

        $cmb->add_field( array(
            'name' => 'تبلیغات صفحه اصلی',
            'type' => 'title',
            'id'   => 'woolearn_ads'
        ) );

        $woolearn_ads_group = $cmb->add_field( array(
            'id'          => 'woolearn_ads_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => "آیتم {#}",
                'add_button'    => "افزودن آیتم جدید",
                'remove_button' => "حذف آیتم",
                'sortable'      => true, // beta
            ),
        ) );

        $cmb->add_group_field( $woolearn_ads_group, array(
            'name' => 'عنوان تبلیغ',
            'id'   => 'title',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_ads_group, array(
            'name' => 'لینک تبلیغ',
            'id'   => 'link',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_ads_group, array(
            'name' => 'عکس تبلیغ',
            'id'   => 'image',
            'type' => 'file',
            // Optional:
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'text'    => array(
                'add_upload_file_text' => 'انتخاب عکس' // Change upload button text. Default: "Add or Upload File"
            ),
        ) );



        // index support section

        $cmb->add_field( array(
            'name' => 'پشتیبان ها',
            'type' => 'title',
            'id'   => 'woolearn_support'
        ) );

        $woolearn_support_group = $cmb->add_field( array(
            'id'          => 'woolearn_support_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => "آیتم {#}",
                'add_button'    => "افزودن آیتم جدید",
                'remove_button' => "حذف آیتم",
                'sortable'      => true, // beta
				'closed' => true,
            ),
        ) );

        $cmb->add_group_field( $woolearn_support_group, array(
            'name' => 'لینک',
            'id'   => 'link',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_support_group, array(
            'name' => 'عکس',
            'id'   => 'image',
            'type' => 'file',
            // Optional:
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'text'    => array(
                'add_upload_file_text' => 'انتخاب عکس' // Change upload button text. Default: "Add or Upload File"
            ),
        ) );



        // Pre order section

        $woolearn_preorder_group = $cmb->add_field( array(
            'id'          => 'woolearn_preorder_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => false,
            'options'     => array(
                'group_title'   => "پیش سفارش",
				'closed' => true,
            ),
        ) );

        $cmb->add_group_field( $woolearn_preorder_group, array(
            'name' => 'عنوان پیش سفارش',
            'id'   => 'title',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_preorder_group, array(
            'name' => 'متن پیش سفارش',
            'id'   => 'desc',
            'type' => 'textarea_small',
        ) );

        $cmb->add_group_field( $woolearn_preorder_group, array(
            'name' => 'Contact Shortcode',
            'id'   => 'contact_form',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_preorder_group, array(
            'name' => 'عکس',
            'id'   => 'image',
            'type' => 'file',
            // Optional:
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'text'    => array(
                'add_upload_file_text' => 'انتخاب عکس' // Change upload button text. Default: "Add or Upload File"
            ),
        ) );





        // index middle slider

        $cmb->add_field( array(
            'name' => 'اسلایدر وسط صفحه',
            'type' => 'title',
            'id'   => 'woolearn_slider_middle'
        ) );

        $woolearn_slider_middle_group = $cmb->add_field( array(
            'id'          => 'woolearn_slider_middle_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => "اسلایدر وسط صفحه {#}",
                'add_button'    => "افزودن اسلایدر جدید",
                'remove_button' => "حذف اسلاید",
                'sortable'      => true, // beta
            ),
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'عنوان',
            'id'   => 'title1',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'توضیح',
            'id'   => 'desc1',
            'type' => 'textarea_small',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'متن دکمه راست',
            'id'   => 'first_button1',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'لینک دکمه راست',
            'id'   => 'first_button_link1',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'متن دکمه چپ',
            'id'   => 'second_button1',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'لینک دکمه چپ',
            'id'   => 'second_button_link1',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'عکس اسلاید',
            'id'   => 'image1',
            'type' => 'file',
            // Optional:
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'text'    => array(
                'add_upload_file_text' => 'انتخاب عکس' // Change upload button text. Default: "Add or Upload File"
            ),
        ) );

        //product 2
        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'عنوان',
            'id'   => 'title2',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'توضیح',
            'id'   => 'desc2',
            'type' => 'textarea_small',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'متن دکمه راست',
            'id'   => 'first_button2',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'لینک دکمه راست',
            'id'   => 'first_button_link2',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'متن دکمه چپ',
            'id'   => 'second_button2',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'لینک دکمه چپ',
            'id'   => 'second_button_link2',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_slider_middle_group, array(
            'name' => 'عکس اسلاید',
            'id'   => 'image2',
            'type' => 'file',
            // Optional:
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'text'    => array(
                'add_upload_file_text' => 'انتخاب عکس' // Change upload button text. Default: "Add or Upload File"
            ),
        ) );




        //footer
        $woolearn_footer_group = $cmb->add_field( array(
            'id'          => 'woolearn_footer_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => false,
            'options'     => array(
                'group_title'   => "فوتر",
				'closed' => true,
            ),
        ) );

        $cmb->add_group_field( $woolearn_footer_group, array(
            'name' => 'کپی رایت',
            'id'   => 'copy',
            'type' => 'text',
        ) );



        // index Offer section
        $woolearn_offer_group = $cmb->add_field( array(
            'id'          => 'woolearn_offer_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => false, // use false if you want non-repeatable group
            'options'     => array(
                'group_title'   => "بخش پیشنهاد شگفت انگیز",
            ),
        ) );

        $cmb->add_group_field( $woolearn_offer_group, array(
            'name' => 'عنوان',
            'id'   => 'title',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_offer_group, array(
            'name' => 'زیر عنوان',
            'id'   => 'subtitle',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_offer_group, array(
            'name' => 'تاریخ شروع پیشنهاد ویژه',
            'id'   => 'start_timestamp',
            'type' => 'text_datetime_timestamp',
        ) );
        $cmb->add_group_field( $woolearn_offer_group, array(
            'name' => 'مدت',
            'id'   => 'duration',
            'type' => 'text_small',
            'desc' => 'min',
        ) );

        $cmb->add_group_field( $woolearn_offer_group, array(
            'name' => 'عنوان لینک دکمه',
            'id'   => 'button_text',
            'type' => 'text',
        ) );

        $cmb->add_group_field( $woolearn_offer_group, array(
            'name' => 'آدرس لینک دکمه',
            'id'   => 'button_link',
            'type' => 'text_url',
        ) );

        $cmb->add_group_field( $woolearn_offer_group, array(
            'name' => 'عکس',
            'id'   => 'image',
            'type' => 'file',
            // Optional:
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'text'    => array(
                'add_upload_file_text' => 'انتخاب عکس' // Change upload button text. Default: "Add or Upload File"
            ),
        ) );
		
		
		
		$cmb->add_field( array(
            'name' => 'تب اسلایدر',
            'type' => 'title',
            'id'   => 'woolearn_tab_slider'
        ) );

        $woolearn_tab_slider_group = $cmb->add_field( array(
            'id'          => 'woolearn_tab_slider_group',
            'type'        => 'group',
            'description' => '',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => "تب {#}",
                'add_button'    => "افزودن تب",
                'remove_button' => "حذف تب",
                'closed' => true,
               
            ),
        ) );
		
		$cmb->add_group_field( $woolearn_tab_slider_group, array(
            'name' => 'دسته محصول',
            'id'   => 'tab_cat',
            'desc' =>'',
            'type' => 'select',
            'options_cb' => 'woolearn_get_product_option',
        ) );
		
		$cmb->add_group_field( $woolearn_tab_slider_group, array(
            'name' => 'نام آیکون',
            'id'   => 'fa_icon',
            'desc' =>'<a target="_balnk" href="http://fontawesome.io/3.2.1/icons/">انتخاب آیکون</a>',
            'type' => 'text',
        ) );
		

	
		
    }
    /**
     * Register settings notices for display
     *
     * @since  0.1.0
     * @param  int   $object_id Option key
     * @param  array $updated   Array of updated fields
     * @return void
     */
    public function settings_notices( $object_id, $updated ) {
        if ( $object_id !== $this->key || empty( $updated ) ) {
            return;
        }
        add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'woolearn' ), 'updated' );
        settings_errors( $this->key . '-notices' );
    }
    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get( $field ) {
        // Allowed fields to retrieve
        if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
            return $this->{$field};
        }
        throw new Exception( 'Invalid property: ' . $field );
    }
}
/**
 * Helper function to get/return the Woolearn_Admin object
 * @since  0.1.0
 * @return Woolearn_Admin object
 */
function woolearn_admin() {
    return Woolearn_Admin::get_instance();
}
/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function woolearn_get_option( $key = '' ) {
    return cmb2_get_option( woolearn_admin()->key, $key );
}

// Get it started
woolearn_admin();