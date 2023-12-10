<?php
    add_action('rest_api_init', function() {
        register_rest_route( 'route_namespace/v1','route', array(
        // The REST-API will take the form: variableGlobal.root_url + "/wp-json/route_namespace/v1/route
            'methods' => 'GET',
            'callback' => 'getResults',
        ) );
    });

    function getResults($data){  //Truyền parameter
        // print_r($data);
        $query = new WP_Query(
            array(
                'post_type' => ["post"],
                's' => $data['term']
            )
        );
        $new_array = [
            "array" => [],
        ];
        while($query->have_posts()){
            $query-> the_post();
            // code ....
        }
        
        return $new_array;
    }
?>