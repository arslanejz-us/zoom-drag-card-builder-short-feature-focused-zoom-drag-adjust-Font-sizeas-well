<?php

// Exit if accessed directly

if ( !defined( 'ABSPATH' ) ) exit;



// BEGIN ENQUEUE PARENT ACTION

// AUTO GENERATED - Do not modify or remove comment markers above or below:



if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):

    function chld_thm_cfg_locale_css( $uri ){

        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )

            $uri = get_template_directory_uri() . '/rtl.css';

        return $uri;

    }

endif;

add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );



// END ENQUEUE PARENT ACTION





/**

 * Enqueue scripts and styles for Card Layout

 */

function child_enqueue_card_assets() {


    wp_enqueue_script(
        'dom-to-image-more',
        'https://cdn.jsdelivr.net/npm/dom-to-image-more@2.8.0/src/dom-to-image-more.min.js',
        array(),
        '2.8.0',
        true
    );

    wp_enqueue_script(
        'interact-js',
        'https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js',
        array(), null, true
    );


    // Fabric.js

    wp_enqueue_script(

        'fabric-js',

        'https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js',

        array(), null, true

    );



    // html2canvas

    wp_enqueue_script(

        'html2canvas-js',

        'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js',

        array(), null, true

    );

    // Cropper.js

    wp_enqueue_style(

        'cropper-css',

        'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css'

    );

    wp_enqueue_script(

        'cropper-js',
        'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js',
        array('jquery'), null, true

    );



    // QRious

    wp_enqueue_script(

        'qrious-js',

        'https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js',

        array(), null, true

    );



    // Custom CSS

   
    wp_enqueue_style(
        'custom-card-css',
        get_stylesheet_directory_uri() . '/assets/css/custom-card.css',
        array(), // Dependencies (if any)
        '2.0.1202200000344' // ✅ Custom manual version number
    );
    

    // Custom JS

    wp_enqueue_script(

        'custom-card-js',

        get_stylesheet_directory_uri() . '/assets/js/custom-card.js',

        array('jquery', 'fabric-js', 'cropper-js', 'qrious-js'),

        '1.0.2.455545454', 

        true

    );

}

add_action('wp_enqueue_scripts', 'child_enqueue_card_assets');





/**

 * Extra scripts for card capture

 */

function enqueue_card_capture_scripts() {

    wp_enqueue_script( 'html2canvas', 'https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js', array(), null, true );

    wp_enqueue_script( 'html-to-image', 'https://cdn.jsdelivr.net/npm/html-to-image@1.11.11/dist/html-to-image.min.js', array(), null, true );

    wp_enqueue_script( 'card-capture', get_stylesheet_directory_uri() . '/js/card-capture.js', array('html2canvas','html-to-image'), null, true );
    
    wp_enqueue_script( 'sweetalert2', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', [], null, true );


}

add_action( 'wp_enqueue_scripts', 'enqueue_card_capture_scripts' );




function render_card_layout() {
    ob_start();
    get_template_part('template-parts/card-layout');
    return ob_get_clean();
}
add_shortcode('card_layout', 'render_card_layout');

add_filter( 'gfpdf_template_paths', function( $paths ) {
    $paths[] = get_stylesheet_directory() . '/pdf-templates/';
    return $paths;
} );



// add_action( 'gform_pre_submission', 'convert_base64_before_save' );
function convert_base64_before_save( $form ) {
    $upload_dir = wp_upload_dir();

    // field IDs from Gravity Forms (adjust according to your form)
    $fields = [
        27 => 'card_image_front',
        24 => 'card_image_back',
        25 => 'vertical_card_image_front',
        26 => 'vertical_card_image_back'
    ];

    foreach ( $fields as $field_id => $label ) {
        $input_name = 'input_' . $field_id; // GF stores in $_POST[input_ID]
        
        if ( empty( $_POST[ $input_name ] ) ) {
            continue;
        }

        $base64 = $_POST[ $input_name ];
        $base64 = preg_replace('#^data:image/\w+;base64,#i', '', $base64);
        $image_data = base64_decode( $base64 );

        if ( ! $image_data ) {
            continue;
        }

        $filename   = $label . '-' . time() . '.png';
        $file_path  = trailingslashit( $upload_dir['path'] ) . $filename;
        $file_url   = trailingslashit( $upload_dir['url'] ) . $filename;

        file_put_contents( $file_path, $image_data );

        // Replace POST so GF saves URL
        $_POST[ $input_name ] = $file_url;
    }
}


// add_action('gform_after_submission_1', 'send_entry_to_gsheet_only', 10, 2);
// function send_entry_to_gsheet_only($entry, $form) {
//     // ---- GOOGLE API CLIENT INIT ----
//     // require_once get_stylesheet_directory() . '/google-api-php-client/vendor/autoload.php';
//     require_once WP_CONTENT_DIR . '/google-api-php-client/vendor/autoload.php';


//     $client = new Google_Client();
//     // $client->setAuthConfig(get_stylesheet_directory() . '/credentials.json');
//     $client->setAuthConfig(WP_CONTENT_DIR . '/gdrive/credentials.json');

//     $client->addScope(Google_Service_Sheets::SPREADSHEETS);

//     $sheetsService = new Google_Service_Sheets($client);

//     // ---- GOOGLE SHEET ID ----
//     $spreadsheetId = '1m6aOqw967xy6AlLcnNTnJhypAxhAEXbLhdHIXYdHSO8';
//     $range = 'Sheet1!A:Z'; // Adjust if your sheet name is different

//     // ---- GET PDF URL (robust, with fallbacks) ----
//     $pdf_url = '';

//     if ( class_exists('GPDFAPI') ) {
//         // 1) Try entry-specific PDFs (preferred)
//         if ( method_exists('GPDFAPI','get_entry_pdfs') ) {
//             $pdfs = GPDFAPI::get_entry_pdfs( (int) rgar($entry,'id') );
//             if ( !is_wp_error($pdfs) && !empty($pdfs) && is_array($pdfs) ) {
//                 $first_pdf = reset($pdfs); // takes the first matching PDF feed
//                 // common keys that Gravity PDF exposes in display lists
//                 if ( !empty($first_pdf['download']) ) {
//                     $pdf_url = $first_pdf['download'];
//                 } elseif ( !empty($first_pdf['view']) ) {
//                     $pdf_url = $first_pdf['view'];
//                 } elseif ( !empty($first_pdf['url']) ) {
//                     $pdf_url = $first_pdf['url'];
//                 } else {
//                     // Try Model_PDF helper
//                     $model = GPDFAPI::get_mvc_class('Model_PDF');
//                     if ( $model && method_exists($model, 'get_pdf_url') ) {
//                         $pdf_id = $first_pdf['pid'] ?? $first_pdf['id'] ?? $first_pdf['pdf_id'] ?? null;
//                         if ( $pdf_id ) {
//                             $pdf_url = $model->get_pdf_url( $pdf_id, (int) rgar($entry,'id'), false, false );
//                         }
//                     }
//                 }
//             }
//         }

//         // 2) Fallback: try form-level PDFs then Model_PDF
//         if ( empty($pdf_url) && method_exists('GPDFAPI','get_form_pdfs') ) {
//             $form_id = isset($form['id']) ? (int) $form['id'] : (int) rgar($entry,'form_id');
//             if ( $form_id ) {
//                 $form_pdfs = GPDFAPI::get_form_pdfs( $form_id );
//                 if ( !is_wp_error($form_pdfs) && !empty($form_pdfs) && is_array($form_pdfs) ) {
//                     $first_pdf = reset($form_pdfs);
//                     $pdf_id = $first_pdf['pid'] ?? $first_pdf['id'] ?? null;
//                     $model = GPDFAPI::get_mvc_class('Model_PDF');
//                     if ( $pdf_id && $model && method_exists($model,'get_pdf_url') ) {
//                         $pdf_url = $model->get_pdf_url( $pdf_id, (int) rgar($entry,'id'), false, false );
//                     }
//                 }
//             }
//         }
//     }

//     // ---- COLLECT ENTRY DATA (same columns as you had) ----
//     $rowData = [
//         rgar($entry, '19'),   // First Name
//         rgar($entry, '20'),   // Last Name
//         rgar($entry, '3'),    // Email
//         rgar($entry, '4'),    // Job Title
//         $pdf_url              // Gravity PDF Link (may be empty)
//     ];

//     // ---- APPEND TO GOOGLE SHEET ----
//     $sheetsService->spreadsheets_values->append(
//         $spreadsheetId,
//         $range,
//         new Google_Service_Sheets_ValueRange(['values' => [$rowData]]),
//         ['valueInputOption' => 'RAW']
//     );
// }

add_filter( 'wp_image_editors', function( $editors ) {
    return ['WP_Image_Editor_GD'];
});

 
// Save Gravity PDF URL(s) to entry meta after submission (Form ID = 1)
add_action( 'gform_after_submission_1', 'gwp_save_gravitypdf_links_after_submission', 20, 2 );
function gwp_save_gravitypdf_links_after_submission( $entry, $form ) {
    // Safety: make sure Gravity PDF is active
    if ( ! class_exists( 'GPDFAPI' ) ) {
        return;
    }

    $entry_id = (int) rgar( $entry, 'id' );
    $form_id  = (int) rgar( $form, 'id' );

    // Try to get PDFs that apply to this entry (respects conditional logic)
    $pdfs = array();

    if ( method_exists( 'GPDFAPI', 'get_entry_pdfs' ) ) {
        $pdfs = GPDFAPI::get_entry_pdfs( $entry_id );
    }

    // Fallback to all form PDFs if none found for entry
    if ( is_wp_error( $pdfs ) || empty( $pdfs ) ) {
        if ( method_exists( 'GPDFAPI', 'get_form_pdfs' ) ) {
            $pdfs = GPDFAPI::get_form_pdfs( $form_id );
        } else {
            $pdfs = array();
        }
    }

    if ( is_wp_error( $pdfs ) || empty( $pdfs ) ) {
        // nothing to save
        gform_update_meta( $entry_id, 'generated_pdf_url', '' );
        return;
    }

    // Get the Model_PDF class (used to build pdf URLs)
    if ( ! method_exists( 'GPDFAPI', 'get_mvc_class' ) ) {
        return;
    }
    $model_pdf = GPDFAPI::get_mvc_class( 'Model_PDF' );
    if ( ! $model_pdf || ! is_object( $model_pdf ) || ! method_exists( $model_pdf, 'get_pdf_url' ) ) {
        return;
    }

    $collected_urls = array();

    foreach ( $pdfs as $pdf ) {
        // Try multiple common keys for the PDF ID / pid, be defensive
        $pid = ! empty( $pdf['pid'] ) ? $pdf['pid'] : ( ! empty( $pdf['id'] ) ? $pdf['id'] : ( ! empty( $pdf['pdf_id'] ) ? $pdf['pdf_id'] : '' ) );

        // Some internal structures might have settings.pid
        if ( empty( $pid ) && ! empty( $pdf['settings']['pid'] ) ) {
            $pid = $pdf['settings']['pid'];
        }

        if ( empty( $pid ) ) {
            continue;
        }

        // Try to get a signed URL for safe public access (method accepts pid and entry id)
        try {
            // Third/fourth args are optional in Gravity PDF; use sensible defaults (raw=false, signed=true).
            $pdf_url = $model_pdf->get_pdf_url( $pid, $entry_id, false, true );
        } catch ( Throwable $e ) {
            // Log but don't break the request
            error_log( sprintf( 'GPDF get_pdf_url error (entry %d pid %s): %s', $entry_id, $pid, $e->getMessage() ) );
            $pdf_url = '';
        }

        if ( $pdf_url ) {
            $collected_urls[] = $pdf_url;
        } else {
            // As an extra attempt: generate the PDF and try to derive a URL (optional)
            if ( method_exists( 'GPDFAPI', 'create_pdf' ) ) {
                try {
                    $abs_path = GPDFAPI::create_pdf( $entry_id, $pid );
                    // convert path to URL using Gravity PDF helper if available
                    if ( $abs_path && method_exists( $model_pdf, 'convert_path_to_url' ) ) {
                        $maybe_url = $model_pdf->convert_path_to_url( $abs_path );
                        if ( $maybe_url ) {
                            $collected_urls[] = $maybe_url;
                        }
                    }
                } catch ( Throwable $e ) {
                    error_log( sprintf( 'GPDF create_pdf error (entry %d pid %s): %s', $entry_id, $pid, $e->getMessage() ) );
                }
            }
        }
    }

    // Save to entry meta (single string or JSON array if multiple)
    if ( empty( $collected_urls ) ) {
        gform_update_meta( $entry_id, 'generated_pdf_url', '' );
    } elseif ( count( $collected_urls ) === 1 ) {
        gform_update_meta( $entry_id, 'generated_pdf_url', $collected_urls[0] );
    } else {
        gform_update_meta( $entry_id, 'generated_pdf_url', wp_json_encode( $collected_urls ) );
    }
}









// Add "PDF Download" column to entries list for form ID 1
add_filter( 'gform_entry_list_columns', 'gwp_add_pdf_column_entry_list', 10, 2 );
function gwp_add_pdf_column_entry_list( $columns, $form_id ) {
    if ( (int) $form_id === 1 ) {
        $columns['generated_pdf_url'] = 'PDF Download';
    }
    return $columns;
}

// Render our PDF column content
add_filter( 'gform_entries_field_value', 'gwp_render_pdf_column_value', 10, 4 );
function gwp_render_pdf_column_value( $value, $form_id, $field_id, $entry ) {
    if ( (int) $form_id !== 1 || $field_id !== 'generated_pdf_url' ) {
        return $value;
    }

    $meta = gform_get_meta( $entry['id'], 'generated_pdf_url' );
    if ( empty( $meta ) ) {
        return 'No PDF';
    }

    $links = array();

    // If stored JSON decode it, otherwise if it's a URL put into array
    if ( is_string( $meta ) ) {
        $maybe = json_decode( $meta, true );
        if ( is_array( $maybe ) ) {
            $links = $maybe;
        } elseif ( filter_var( $meta, FILTER_VALIDATE_URL ) ) {
            $links = array( $meta );
        } else {
            // try unserialize fallback
            $un = maybe_unserialize( $meta );
            if ( is_array( $un ) ) {
                $links = $un;
            }
        }
    } elseif ( is_array( $meta ) ) {
        $links = $meta;
    }

    if ( empty( $links ) ) {
        return 'No PDF';
    }

    $out = array();
    foreach ( $links as $idx => $link ) {
        $label = 'PDF ' . ( $idx + 1 );
        $out[] = sprintf( '<a class="button" href="%s" target="_blank" rel="noopener noreferrer">%s</a>', esc_url( $link ), esc_html( $label ) );
    }

    return implode( '<br>', $out );
}



add_filter('gform_field_validation', function($result, $value, $form, $field) {
    // Replace 3 with your File Upload field ID
    $fileUploadFieldID = 3;

    if ($field->id == $fileUploadFieldID && !empty($_FILES['input_' . $field->id]['tmp_name'])) {
        $fileTmpName = $_FILES['input_' . $field->id]['tmp_name'];
        $fileSize = filesize($fileTmpName); // bytes

        // Minimum size in bytes (4 KB = 4 * 1024 = 4096)
        if ($fileSize < 4096) {
            $result['is_valid'] = false;
            $result['message'] = 'File is too small. Minimum size is 4 KB.';
        }
    }

    return $result;
}, 10, 4);



// add_filter('gform_pre_render', 'populate_country_codes_dropdown');
// add_filter('gform_pre_validation', 'populate_country_codes_dropdown');
// add_filter('gform_pre_submission_filter', 'populate_country_codes_dropdown');
// add_filter('gform_admin_pre_render', 'populate_country_codes_dropdown');

// function populate_country_codes_dropdown($form) {
//     foreach ($form['fields'] as &$field) {
//         // ðŸ‘‡ Change "5" to your Gravity Forms Dropdown field ID
//         if ($field->id == 38 && $field->type == 'select') {
            
//             $countries = array(
//                 'Afghanistan' => '\'+93 (Afghanistan)',
//                 'Albania' => '\'+355 (Albania)',
//                 'Algeria' => '\'+213 (Algeria)',
//                 'Andorra' => '\'+376 (Andorra)',
//                 'Angola' => '\'+244 (Angola)',
//                 'Argentina' => '\'+54 (Argentina)',
//                 'Armenia' => '\'+374 (Armenia)',
//                 'Australia' => '\'+61 (Australia)',
//                 'Austria' => '\'+43 (Austria)',
//                 'Azerbaijan' => '\'+994 (Azerbaijan)',
//                 'Bahrain' => '\'+973 (Bahrain)',
//                 'Bangladesh' => '\'+880 (Bangladesh)',
//                 'Belarus' => '\'+375 (Belarus)',
//                 'Belgium' => '\'+32 (Belgium)',
//                 'Belize' => '\'+501 (Belize)',
//                 'Benin' => '\'+229 (Benin)',
//                 'Bhutan' => '\'+975 (Bhutan)',
//                 'Bolivia' => '\'+591 (Bolivia)',
//                 'Bosnia and Herzegovina' => '\'+387 (Bosnia and Herzegovina)',
//                 'Botswana' => '\'+267 (Botswana)',
//                 'Brazil' => '\'+55 (Brazil)',
//                 'Brunei' => '\'+673 (Brunei)',
//                 'Bulgaria' => '\'+359 (Bulgaria)',
//                 'Cambodia' => '\'+855 (Cambodia)',
//                 'Cameroon' => '\'+237 (Cameroon)',
//                 'Canada' => '\'+1 (Canada)',
//                 'Chile' => '\'+56 (Chile)',
//                 'China' => '\'+86 (China)',
//                 'Colombia' => '\'+57 (Colombia)',
//                 'Costa Rica' => '\'+506 (Costa Rica)',
//                 'Croatia' => '\'+385 (Croatia)',
//                 'Cuba' => '\'+53 (Cuba)',
//                 'Cyprus' => '\'+357 (Cyprus)',
//                 'Czech Republic' => '\'+420 (Czech Republic)',
//                 'Denmark' => '\'+45 (Denmark)',
//                 'Dominican Republic' => '\'+1-809 (Dominican Republic)',
//                 'Ecuador' => '\'+593 (Ecuador)',
//                 'Egypt' => '\'+20 (Egypt)',
//                 'Estonia' => '\'+372 (Estonia)',
//                 'Ethiopia' => '\'+251 (Ethiopia)',
//                 'Finland' => '\'+358 (Finland)',
//                 'France' => '\'+33 (France)',
//                 'Georgia' => '\'+995 (Georgia)',
//                 'Germany' => '\'+49 (Germany)',
//                 'Greece' => '\'+30 (Greece)',
//                 'Hong Kong' => '\'+852 (Hong Kong)',
//                 'Hungary' => '\'+36 (Hungary)',
//                 'Iceland' => '\'+354 (Iceland)',
//                 'India' => '\'+91 (India)',
//                 'Indonesia' => '\'+62 (Indonesia)',
//                 'Iran' => '\'+98 (Iran)',
//                 'Iraq' => '\'+964 (Iraq)',
//                 'Ireland' => '\'+353 (Ireland)',
//                 'Israel' => '\'+972 (Israel)',
//                 'Italy' => '\'+39 (Italy)',
//                 'Japan' => '\'+81 (Japan)',
//                 'Jordan' => '\'+962 (Jordan)',
//                 'Kazakhstan' => '\'+7 (Kazakhstan)',
//                 'Kenya' => '\'+254 (Kenya)',
//                 'Kuwait' => '\'+965 (Kuwait)',
//                 'Kyrgyzstan' => '\'+996 (Kyrgyzstan)',
//                 'Laos' => '\'+856 (Laos)',
//                 'Latvia' => '\'+371 (Latvia)',
//                 'Lebanon' => '\'+961 (Lebanon)',
//                 'Libya' => '\'+218 (Libya)',
//                 'Lithuania' => '\'+370 (Lithuania)',
//                 'Luxembourg' => '\'+352 (Luxembourg)',
//                 'Macau' => '\'+853 (Macau)',
//                 'Malaysia' => '\'+60 (Malaysia)',
//                 'Maldives' => '\'+960 (Maldives)',
//                 'Mali' => '\'+223 (Mali)',
//                 'Malta' => '\'+356 (Malta)',
//                 'Mexico' => '\'+52 (Mexico)',
//                 'Moldova' => '\'+373 (Moldova)',
//                 'Monaco' => '\'+377 (Monaco)',
//                 'Mongolia' => '\'+976 (Mongolia)',
//                 'Montenegro' => '\'+382 (Montenegro)',
//                 'Morocco' => '\'+212 (Morocco)',
//                 'Nepal' => '\'+977 (Nepal)',
//                 'Netherlands' => '\'+31 (Netherlands)',
//                 'New Zealand' => '\'+64 (New Zealand)',
//                 'Nigeria' => '\'+234 (Nigeria)',
//                 'North Korea' => '\'+850 (North Korea)',
//                 'Norway' => '\'+47 (Norway)',
//                 'Oman' => '\'+968 (Oman)',
//                 'Pakistan' => '\'+92 (Pakistan)',
//                 'Palestine' => '\'+970 (Palestine)',
//                 'Panama' => '\'+507 (Panama)',
//                 'Paraguay' => '\'+595 (Paraguay)',
//                 'Peru' => '\'+51 (Peru)',
//                 'Philippines' => '\'+63 (Philippines)',
//                 'Poland' => '\'+48 (Poland)',
//                 'Portugal' => '\'+351 (Portugal)',
//                 'Qatar' => '\'+974 (Qatar)',
//                 'Romania' => '\'+40 (Romania)',
//                 'Russia' => '\'+7 (Russia)',
//                 'Saudi Arabia' => '\'+966 (Saudi Arabia)',
//                 'Serbia' => '\'+381 (Serbia)',
//                 'Singapore' => '\'+65 (Singapore)',
//                 'Slovakia' => '\'+421 (Slovakia)',
//                 'Slovenia' => '\'+386 (Slovenia)',
//                 'South Africa' => '\'+27 (South Africa)',
//                 'South Korea' => '\'+82 (South Korea)',
//                 'Spain' => '\'+34 (Spain)',
//                 'Sri Lanka' => '\'+94 (Sri Lanka)',
//                 'Sudan' => '\'+249 (Sudan)',
//                 'Sweden' => '\'+46 (Sweden)',
//                 'Switzerland' => '\'+41 (Switzerland)',
//                 'Syria' => '\'+963 (Syria)',
//                 'Taiwan' => '\'+886 (Taiwan)',
//                 'Tajikistan' => '\'+992 (Tajikistan)',
//                 'Tanzania' => '\'+255 (Tanzania)',
//                 'Thailand' => '\'+66 (Thailand)',
//                 'Turkey' => '\'+90 (Turkey)',
//                 'Turkmenistan' => '\'+993 (Turkmenistan)',
//                 'Uganda' => '\'+256 (Uganda)',
//                 'Ukraine' => '\'+380 (Ukraine)',
//                 'United Arab Emirates' => '\'+971 (United Arab Emirates)',
//                 'United Kingdom' => '\'+44 (United Kingdom)',
//                 'United States' => '\'+1 (United States)',
//                 'Uruguay' => '\'+598 (Uruguay)',
//                 'Uzbekistan' => '\'+998 (Uzbekistan)',
//                 'Venezuela' => '\'+58 (Venezuela)',
//                 'Vietnam' => '\'+84 (Vietnam)',
//                 'Yemen' => '\'+967 (Yemen)',
//                 'Zambia' => '\'+260 (Zambia)',
//                 'Zimbabwe' => '\'+263 (Zimbabwe)',
//             );
            
            
            
//             $field->choices = array();
//             foreach ($countries as $country => $code) {
//                 $field->choices[] = array(
//                     'text'  =>   $code ,
//                     'value' => $code,
//                     'isSelected' => ($country === 'United States')
//                 );
//             }
//         }
//     }
//     return $form;
// }

add_filter('gform_pre_render', 'populate_country_codes_dropdown');
add_filter('gform_pre_validation', 'populate_country_codes_dropdown');
add_filter('gform_pre_submission_filter', 'populate_country_codes_dropdown');
add_filter('gform_admin_pre_render', 'populate_country_codes_dropdown');

function populate_country_codes_dropdown($form) {
    foreach ($form['fields'] as &$field) {
        // Change 38 to your field ID
        if ($field->id == 38 && $field->type == 'select') {

            $countries = array(
                'Afghanistan' => '+93 (Afghanistan)',
                'Albania' => '+355 (Albania)',
                'Algeria' => '+213 (Algeria)',
                'Andorra' => '+376 (Andorra)',
                'Angola' => '+244 (Angola)',
                'Argentina' => '+54 (Argentina)',
                'Armenia' => '+374 (Armenia)',
                'Australia' => '+61 (Australia)',
                'Austria' => '+43 (Austria)',
                'Azerbaijan' => '+994 (Azerbaijan)',
                'Bahrain' => '+973 (Bahrain)',
                'Bangladesh' => '+880 (Bangladesh)',
                'Belarus' => '+375 (Belarus)',
                'Belgium' => '+32 (Belgium)',
                'Belize' => '+501 (Belize)',
                'Benin' => '+229 (Benin)',
                'Bhutan' => '+975 (Bhutan)',
                'Bolivia' => '+591 (Bolivia)',
                'Bosnia and Herzegovina' => '+387 (Bosnia and Herzegovina)',
                'Botswana' => '+267 (Botswana)',
                'Brazil' => '+55 (Brazil)',
                'Brunei' => '+673 (Brunei)',
                'Bulgaria' => '+359 (Bulgaria)',
                'Cambodia' => '+855 (Cambodia)',
                'Cameroon' => '+237 (Cameroon)',
                'Canada' => '+1 (Canada)',
                'Chile' => '+56 (Chile)',
                'China' => '+86 (China)',
                'Colombia' => '+57 (Colombia)',
                'Costa Rica' => '+506 (Costa Rica)',
                'Croatia' => '+385 (Croatia)',
                'Cuba' => '+53 (Cuba)',
                'Cyprus' => '+357 (Cyprus)',
                'Czech Republic' => '+420 (Czech Republic)',
                'Denmark' => '+45 (Denmark)',
                'Dominican Republic' => '+1-809 (Dominican Republic)',
                'Ecuador' => '+593 (Ecuador)',
                'Egypt' => '+20 (Egypt)',
                'Estonia' => '+372 (Estonia)',
                'Ethiopia' => '+251 (Ethiopia)',
                'Finland' => '+358 (Finland)',
                'France' => '+33 (France)',
                'Georgia' => '+995 (Georgia)',
                'Germany' => '+49 (Germany)',
                'Greece' => '+30 (Greece)',
                'Hong Kong' => '+852 (Hong Kong)',
                'Hungary' => '+36 (Hungary)',
                'Iceland' => '+354 (Iceland)',
                'India' => '+91 (India)',
                'Indonesia' => '+62 (Indonesia)',
                'Iran' => '+98 (Iran)',
                'Iraq' => '+964 (Iraq)',
                'Ireland' => '+353 (Ireland)',
                'Israel' => '+972 (Israel)',
                'Italy' => '+39 (Italy)',
                'Japan' => '+81 (Japan)',
                'Jordan' => '+962 (Jordan)',
                'Kazakhstan' => '+7 (Kazakhstan)',
                'Kenya' => '+254 (Kenya)',
                'Kuwait' => '+965 (Kuwait)',
                'Kyrgyzstan' => '+996 (Kyrgyzstan)',
                'Laos' => '+856 (Laos)',
                'Latvia' => '+371 (Latvia)',
                'Lebanon' => '+961 (Lebanon)',
                'Libya' => '+218 (Libya)',
                'Lithuania' => '+370 (Lithuania)',
                'Luxembourg' => '+352 (Luxembourg)',
                'Macau' => '+853 (Macau)',
                'Malaysia' => '+60 (Malaysia)',
                'Maldives' => '+960 (Maldives)',
                'Mali' => '+223 (Mali)',
                'Malta' => '+356 (Malta)',
                'Mexico' => '+52 (Mexico)',
                'Moldova' => '+373 (Moldova)',
                'Monaco' => '+377 (Monaco)',
                'Mongolia' => '+976 (Mongolia)',
                'Montenegro' => '+382 (Montenegro)',
                'Morocco' => '+212 (Morocco)',
                'Nepal' => '+977 (Nepal)',
                'Netherlands' => '+31 (Netherlands)',
                'New Zealand' => '+64 (New Zealand)',
                'Nigeria' => '+234 (Nigeria)',
                'North Korea' => '+850 (North Korea)',
                'Norway' => '+47 (Norway)',
                'Oman' => '+968 (Oman)',
                'Pakistan' => '+92 (Pakistan)',
                'Palestine' => '+970 (Palestine)',
                'Panama' => '+507 (Panama)',
                'Paraguay' => '+595 (Paraguay)',
                'Peru' => '+51 (Peru)',
                'Philippines' => '+63 (Philippines)',
                'Poland' => '+48 (Poland)',
                'Portugal' => '+351 (Portugal)',
                'Qatar' => '+974 (Qatar)',
                'Romania' => '+40 (Romania)',
                'Russia' => '+7 (Russia)',
                'Saudi Arabia' => '+966 (Saudi Arabia)',
                'Serbia' => '+381 (Serbia)',
                'Singapore' => '+65 (Singapore)',
                'Slovakia' => '+421 (Slovakia)',
                'Slovenia' => '+386 (Slovenia)',
                'South Africa' => '+27 (South Africa)',
                'South Korea' => '+82 (South Korea)',
                'Spain' => '+34 (Spain)',
                'Sri Lanka' => '+94 (Sri Lanka)',
                'Sudan' => '+249 (Sudan)',
                'Sweden' => '+46 (Sweden)',
                'Switzerland' => '+41 (Switzerland)',
                'Syria' => '+963 (Syria)',
                'Taiwan' => '+886 (Taiwan)',
                'Tajikistan' => '+992 (Tajikistan)',
                'Tanzania' => '+255 (Tanzania)',
                'Thailand' => '+66 (Thailand)',
                'Turkey' => '+90 (Turkey)',
                'Turkmenistan' => '+993 (Turkmenistan)',
                'Uganda' => '+256 (Uganda)',
                'Ukraine' => '+380 (Ukraine)',
                'United Arab Emirates' => '+971 (United Arab Emirates)',
                'United Kingdom' => '+44 (United Kingdom)',
                'United States' => '+1 (United States)',
                'Uruguay' => '+598 (Uruguay)',
                'Uzbekistan' => '+998 (Uzbekistan)',
                'Venezuela' => '+58 (Venezuela)',
                'Vietnam' => '+84 (Vietnam)',
                'Yemen' => '+967 (Yemen)',
                'Zambia' => '+260 (Zambia)',
                'Zimbabwe' => '+263 (Zimbabwe)',
            );

            $field->choices = array();
            foreach ($countries as $country => $code) {
                $safe_code = "'".$code; // Excel-safe version
                $field->choices[] = array(
                    'text'       => $code,      // clean for UI
                    'value'      => $safe_code, // safe for Excel export
                    'isSelected' => ($country === 'United States'),
                );
            }
        }
    }
    return $form;
}

add_action('gfpdf_post_save_pdf', function($path, $filename, $settings, $entry, $form) {

    $upload_dir = wp_upload_dir();
    $save_dir   = $upload_dir['basedir'] . '/gravity-pdfs/';
    $save_url   = $upload_dir['baseurl'] . '/gravity-pdfs/';

    if (!file_exists($save_dir)) {
        wp_mkdir_p($save_dir);
    }

    $FirstName = rgar($entry, 19);
    $LastName  = rgar($entry, 20);
    $Email     = rgar($entry, 3);

    // Define filenames
    // $small_filename        = sanitize_file_name("{$FirstName}-{$LastName}-{$Email}-small.pdf");
    // $large_front_filename  = sanitize_file_name("{$FirstName}-{$LastName}-{$Email}-front-large.pdf");
    // $large_back_filename   = sanitize_file_name("{$FirstName}-{$LastName}-{$Email}-back-large.pdf");

    // Get formatted date (e.g. 10.4.25)
    $date_suffix = date('n.j.y'); 

    // Sanitize base name parts
    $first_name  = sanitize_title($FirstName);
    $last_name   = sanitize_title($LastName);

    // Build filenames
    $small_filename       = sanitize_file_name("{$last_name}{$first_name}SM{$date_suffix}.pdf");
    $large_front_filename = sanitize_file_name("{$last_name}{$first_name}LGFRONT{$date_suffix}.pdf");
    $large_back_filename  = sanitize_file_name("{$last_name}{$first_name}LGBACK{$date_suffix}.pdf");

    
    $filename = sanitize_file_name("{$last_name}{$first_name}.pdf");

    $new_path = '';
    $new_url  = '';
    $meta_key = '';

    // Identify which PDF was just saved
    if ($settings['id'] === '68b949ad2a55f') {
        $new_path = $save_dir . $small_filename;
        $new_url  = $save_url . $small_filename;
        $meta_key = 'small_pdf';
    }

    if ($settings['id'] === '68dcd9e297670') {
        $new_path = $save_dir . $large_front_filename;
        $new_url  = $save_url . $large_front_filename;
        $meta_key = 'large_front_pdf';
    }

    if ($settings['id'] === '68e60984caa7e') {
        $new_path = $save_dir . $large_back_filename;
        $new_url  = $save_url . $large_back_filename;
        $meta_key = 'large_back_pdf';
    }

 

    // Save the generated PDF path + URL
    if (!empty($new_path) && copy($path, $new_path)) {
        gform_update_meta($entry['id'], "{$meta_key}_path", $new_path);
        gform_update_meta($entry['id'], "{$meta_key}_url", $new_url);
    }

    // Retrieve all 3 paths
    $small_path       = gform_get_meta($entry['id'], 'small_pdf_path');
    $large_back_path  = gform_get_meta($entry['id'], 'large_back_pdf_path');
    $large_front_path = gform_get_meta($entry['id'], 'large_front_pdf_path');

    // ✅ Check if all 3 files now exist
    if ($small_path && $large_back_path && $large_front_path &&
        file_exists($small_path) && file_exists($large_back_path) && file_exists($large_front_path)) {
        // ---- Send ALL files together ----

        // old link "https://hook.us1.make.com/mp1xd753yb763muhgdsqu3sbyjiz33hv"

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://hook.us1.make.com/9chswpae6mctkj2qp5scblu16eg2aywf");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'smallFile'      => new CURLFile($small_path, 'application/pdf', basename($small_path)),
            'largeFrontFile' => new CURLFile($large_front_path, 'application/pdf', basename($large_front_path)),
            'largeBackFile'  => new CURLFile($large_back_path, 'application/pdf', basename($large_back_path))
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        // Optional: log for debugging
        error_log("✅ Make.com response for entry {$entry['id']}: " . print_r($response, true));

        $small_path          = $small_path;
        $large_front_path    = $large_front_path;
        $large_back_path     = $large_back_path;

        $FirstName = rgar($entry, 19);
        $LastName  = rgar($entry, 20);
        $Email     = rgar($entry, 3);
        
        $streetAddress  = rgar($entry, '7.1');
        $zipCode        = rgar($entry, '7.5');
        $city           = rgar($entry, '7.3');
        $country        = rgar($entry, 38);
        

     
        // Send form data + PDF URLs to Make.com Excel webhook
        $webhook_url = 'https://hook.us1.make.com/n6it8u4h8jt5qopyk5b37lj58x1tv22q';

          // ✅ Convert absolute paths to public URLs
        $smallCardLink  = ! empty( $small_path ) ? str_replace( $upload_dir['basedir'], $upload_dir['baseurl'], $small_path ) : '';
        $frontLargeLink = ! empty( $large_front_path ) ? str_replace( $upload_dir['basedir'], $upload_dir['baseurl'], $large_front_path ) : '';
        $backLargeLink  = ! empty( $large_back_path ) ? str_replace( $upload_dir['basedir'], $upload_dir['baseurl'], $large_back_path ) : '';


        // Safely collect and sanitize data
        $excel_data = [
            'name'           => trim( sprintf( '%s %s', $FirstName ?? '', $LastName ?? '' ) ),
            'email'          => sanitize_email( $Email ?? '' ),
            'smallCardLink'  => esc_url_raw( $smallCardLink ?? '' ),
            'frontLargeLink' => esc_url_raw(  $frontLargeLink  ?? '' ),
            'backeLargeLink'  => esc_url_raw( $backLargeLink  ?? '' ),
            'streetAddress'  => sanitize_text_field( $streetAddress ?? '' ),
            'zipCode'        => sanitize_text_field( $zipCode ?? '' ),
            'city'           => sanitize_text_field( $city ?? '' ),
            'country'        => sanitize_text_field( $country ?? '' ),

            // 'fileName'        => $filename,
            'smallFileName'  => basename($small_path),
            'largeFileNameFront' => basename($large_front_path),
            'largeFileNameBack'  => basename($large_back_path),
            'dateReceived'    => $date_suffix,
            'firstName'       => sanitize_text_field( $FirstName ?? '' ),
            'lastName '       => sanitize_text_field( $LastName ?? '' ),
        ];


        // echo "<pre>";
        // echo "smallCardLink ".$smallCardLink."<br>";
        // echo "frontLargeLink ".$frontLargeLink."<br>";
        // echo "backLargeLink ".$backLargeLink."<br>";
        // echo "streetAddress ".$streetAddress."<br>";
        // echo "zipCode ".$zipCode."<br>";
        // echo "city ".$city."<br>";
        // echo "country ".$country."<br>";
        // print_r($excel_data);
        // echo "</pre>";

        // die;
        // exit;
        // Remove empty keys (optional — keeps webhook clean)
        $excel_data = array_filter( $excel_data, static function( $value ) {
            return ! empty( $value );
        });

        // Prepare and send POST request
        $response = wp_remote_post(
            $webhook_url,
            [
                'method'  => 'POST',
                'timeout' => 20,
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body'    => $excel_data,
            ]
        );

        // Clean up so it doesn’t resend
        gform_delete_meta($entry['id'], 'small_pdf_path');
        gform_delete_meta($entry['id'], 'large_back_pdf_path');
        gform_delete_meta($entry['id'], 'large_front_pdf_path');
        gform_delete_meta($entry['id'], 'small_pdf_url');
        gform_delete_meta($entry['id'], 'large_back_pdf_url');
        gform_delete_meta($entry['id'], 'large_front_pdf_url');
    }

}, 10, 5);


// ✅ Custom Confirmation Alert + Loader
add_filter( 'gform_confirmation', function( $confirmation, $form, $entry ) {
    $notice = get_transient( 'gf_custom_alert_' . $entry['id'] );
    if ( $notice ) {
        delete_transient( 'gf_custom_alert_' . $entry['id'] );

        $bg  = ( $notice['type'] === 'error' ) ? '#f87171' : '#FDBA19';
        $msg = esc_js( $notice['message'] );

        $script = "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // -------- Loader Remove (jab confirmation mil jaye) --------
            let loader = document.getElementById('gf-loader-overlay');
            if(loader) loader.remove();

            // -------- Custom Alert --------
            let alertBox = document.createElement('div');
            alertBox.innerHTML = '✔ {$msg}';
            alertBox.style.backgroundColor = '{$bg}';
            alertBox.style.color = '#000';
            alertBox.style.padding = '12px 18px';
            alertBox.style.borderRadius = '8px';
            alertBox.style.fontWeight = '600';
            alertBox.style.textAlign = 'center';
            alertBox.style.position = 'fixed';
            alertBox.style.bottom = '30px'; /* 👈 alert niche show hoga */
            alertBox.style.left = '50%';
            alertBox.style.transform = 'translateX(-50%)';
            alertBox.style.zIndex = '9999';
            alertBox.style.boxShadow = '0 4px 12px rgba(0,0,0,0.2)';
            document.body.appendChild(alertBox);

            setTimeout(() => {
                alertBox.remove();
            }, 4000); // 4 second me disappear
        });
        </script>
        ";

        if ( is_string( $confirmation ) ) {
            $confirmation .= $script;
        }
    }
    return $confirmation;
}, 10, 3);


// ✅ Loader + Form Disable on Submit
add_action( 'wp_footer', function() {
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let forms = document.querySelectorAll(".gform_wrapper form");

        forms.forEach(form => {
            form.addEventListener("submit", function () {
                // Disable form inputs
                let inputs = form.querySelectorAll("input, select, textarea, button");
                inputs.forEach(el => el.disabled = true);

                // Loader overlay
                if (!document.getElementById("gf-loader-overlay")) {
                    let loader = document.createElement("div");
                    loader.id = "gf-loader-overlay";
                    loader.style.position = "fixed";
                    loader.style.top = "0";
                    loader.style.left = "0";
                    loader.style.width = "100%";
                    loader.style.height = "100%";
                    loader.style.background = "rgba(255,255,255,0.7)";
                    loader.style.display = "flex";
                    loader.style.justifyContent = "center";
                    loader.style.alignItems = "center";
                    loader.style.zIndex = "99999";
                    loader.innerHTML = `<div class="spinner"></div>`;
                    document.body.appendChild(loader);

                    // Spinner style
                    let style = document.createElement("style");
                    style.innerHTML = `
                        .spinner {
                            border: 6px solid #f3f3f3;
                            border-top: 6px solid #FDBA19;
                            border-radius: 50%;
                            width: 60px;
                            height: 60px;
                            animation: spin 1s linear infinite;
                        }
                        @keyframes spin {
                            0% { transform: rotate(0deg); }
                            100% { transform: rotate(360deg); }
                        }
                    `;
                    document.head.appendChild(style);
                }
            });
        });
    });
    </script>
    <?php
});



 