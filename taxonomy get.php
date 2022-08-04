
function my_exp(){
    register_post_type( 'edu_exp',
        array(
            'labels' => array(
                'name' => __( 'edu_exp'),
                'singular_name' => __('edu_exp')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
            )
        );
    }
add_action( 'init', 'my_exp' );

function custom_taxonomy_ee() {
    $labels = array(
    'name'              => _x( 'edu_exp_Category', 'taxonomy general name', 'textdomain' ),
    'singular_name'     => _x( 'edu_exp_Category', 'taxonomy singular name', 'textdomain' ),
    'search_items'      => __( 'Search edu_exp', 'textdomain' ),
    'all_items'         => __( 'All edu_exp', 'textdomain' ),
    'parent_item'       => __( 'Parent Client', 'textdomain' ),
    'parent_item_colon' => __( 'Parent edu_exp:', 'textdomain' ),
    'edit_item'         => __( 'Edit edu_exp', 'textdomain' ),
    'update_item'       => __( 'Update edu_exp', 'textdomain' ),
    'add_new_item'      => __( 'Add New edu_exp Category', 'textdomain' ),
    'new_item_name'     => __( 'New edu_exp Name', 'textdomain' ),
    'menu_name'         => __( 'edu_exp Category', 'textdomain' ),
);

$args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
);

register_taxonomy( 'edu_exp_tax', array( 'edu_exp' ), $args );

}
add_action('init','custom_taxonomy_ee');


<!--  -->

add_shortcode("education_get","education_get");
function education_get(){
$html .='<section class="time_line timline_section2">'; 


        $args = array(
            'post_type' => 'edu_exp',
            'numberposts' => -1,
            'order'    => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'edu_exp_tax',//taxonomy ka name ayga category ka nhi
                    'field'    => 'education',//category slug call hoga
                    'terms'    => array( '8' ), 
                ),
         )
        );

        $loop = new WP_Query($args);
        while($loop->have_posts()){ $loop->the_post();
            $html .='<div class="timeline_section col-10 ">';

                $html .=  "<div class='ex_year'><div class='year_text'><i class='far fa-calendar'> </i>" . get_field('year') ."</div></div>";
                $html .=  "<h4>" . get_the_title() ."</h4>";
                $html .=  "<p>" . get_the_content() ."<p>";

            $html .='</div>'; 
        }                  
$html .='</section>';
    return $html;
}