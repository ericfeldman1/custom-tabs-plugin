<?php
/**
 * Plugin Name: Custom Tabs Plugin
 * Description: A shortcode-based custom tabs component powered by ACF options.
 * Version: 1.0.0
 * Author: Eric Feldman
 */

add_action('admin_notices', function () {
    echo '<div class="notice notice-success"><p>Custom Tabs plugin loaded.</p></div>';
});

if (!defined('ABSPATH')) {
    exit;
}

define('CTP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CTP_PLUGIN_PATH', plugin_dir_path(__FILE__));

function ctp_enqueue_assets() {
    wp_enqueue_style(
        'ctp-styles',
        CTP_PLUGIN_URL . 'assets/css/custom-tabs.css',
        array(),
        '1.0.0'
    );

    wp_enqueue_script(
        'ctp-scripts',
        CTP_PLUGIN_URL . 'assets/js/custom-tabs.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'ctp_enqueue_assets');


/**
 * ACF Options Page
 */
function ctp_register_options_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title'  => 'Custom Tabs',
            'menu_title'  => 'Custom Tabs',
            'menu_slug'   => 'custom-tabs-settings',
            'capability'  => 'edit_posts',
            'redirect'    => false,
            'position'    => 30,
        ));
    }
}
add_action('acf/init', 'ctp_register_options_page');


/**
 * ACF Field Group
 * Uses fixed tabs so this works with free ACF.
 */
function ctp_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $tabs = array(
        1 => array(
            'label' => 'Retail',
            'quote' => 'Riskified has enabled safe, fast, and seamless payments throughout our collaboration. We’re excited to see what opportunities we can unlock in the future.',
            'name' => 'Michael Fleisher',
            'title' => 'Chief Financial Officer',
            'brand_logo' => 'wayfair',
            'person_image_url' => 'https://images.ctfassets.net/2d5q1td6cyxq/1Qv3example/placeholder-person.jpg',
            'main_image_url' => 'https://images.ctfassets.net/2d5q1td6cyxq/7Pzexample/placeholder-main.jpg',
            'stat_value' => '50%',
            'stat_text' => 'Reduction in the cost of fraud',
            'cta_text' => 'Read Wayfair case study',
            'cta_url' => '#',
            'trusted_logos' => "COSTWAY\nROOMS TO GO\nALDO\nbluemercury",
        ),
        2 => array(
            'label' => 'Luxury fashion',
            'quote' => 'Luxury fashion brands use Riskified to deliver safer, smoother transactions while protecting the customer experience.',
            'name' => 'Jane Doe',
            'title' => 'VP of Ecommerce',
            'brand_logo' => 'brand',
            'person_image_url' => '',
            'main_image_url' => '',
            'stat_value' => '32%',
            'stat_text' => 'Reduction in fraudulent orders',
            'cta_text' => 'Read luxury case study',
            'cta_url' => '#',
            'trusted_logos' => "Brand A\nBrand B\nBrand C\nBrand D",
        ),
        3 => array(
            'label' => 'Digital goods',
            'quote' => 'Digital goods companies need speed and precision, and Riskified helps balance approval rates with protection.',
            'name' => 'John Smith',
            'title' => 'Head of Payments',
            'brand_logo' => 'brand',
            'person_image_url' => '',
            'main_image_url' => '',
            'stat_value' => '18%',
            'stat_text' => 'Increase in approval rate',
            'cta_text' => 'Read digital case study',
            'cta_url' => '#',
            'trusted_logos' => "Brand E\nBrand F\nBrand G\nBrand H",
        ),
        4 => array(
            'label' => 'Travel',
            'quote' => 'Travel merchants rely on Riskified to reduce friction for good customers while preventing costly abuse.',
            'name' => 'Sarah Lee',
            'title' => 'Director of Payments',
            'brand_logo' => 'brand',
            'person_image_url' => '',
            'main_image_url' => '',
            'stat_value' => '41%',
            'stat_text' => 'Lower fraud-related losses',
            'cta_text' => 'Read travel case study',
            'cta_url' => '#',
            'trusted_logos' => "Brand I\nBrand J\nBrand K\nBrand L",
        ),
        5 => array(
            'label' => 'Athletic & Outdoors',
            'quote' => 'Athletic and outdoor brands use Riskified to strengthen fraud prevention without sacrificing conversion.',
            'name' => 'Alex Brown',
            'title' => 'CFO',
            'brand_logo' => 'brand',
            'person_image_url' => '',
            'main_image_url' => '',
            'stat_value' => '27%',
            'stat_text' => 'Decrease in chargebacks',
            'cta_text' => 'Read athletic case study',
            'cta_url' => '#',
            'trusted_logos' => "Brand M\nBrand N\nBrand O\nBrand P",
        ),
    );

    $fields = array(
        array(
            'key' => 'field_ctp_section_title',
            'label' => 'Section Title',
            'name' => 'ctp_section_title',
            'type' => 'text',
            'default_value' => 'Custom Tabs',
        ),
    );

    foreach ($tabs as $i => $tab) {
        $fields[] = array(
            'key' => 'field_ctp_tab_group_' . $i,
            'label' => 'Tab ' . $i,
            'name' => '',
            'type' => 'tab',
            'placement' => 'top',
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_label',
            'label' => 'Tab Label',
            'name' => 'ctp_tab_' . $i . '_label',
            'type' => 'text',
            'default_value' => $tab['label'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_quote',
            'label' => 'Quote',
            'name' => 'ctp_tab_' . $i . '_quote',
            'type' => 'textarea',
            'rows' => 4,
            'default_value' => $tab['quote'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_name',
            'label' => 'Person Name',
            'name' => 'ctp_tab_' . $i . '_name',
            'type' => 'text',
            'default_value' => $tab['name'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_title',
            'label' => 'Person Title',
            'name' => 'ctp_tab_' . $i . '_title',
            'type' => 'text',
            'default_value' => $tab['title'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_person_image_url',
            'label' => 'Person Image URL',
            'name' => 'ctp_tab_' . $i . '_person_image_url',
            'type' => 'url',
            'default_value' => $tab['person_image_url'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_brand_logo',
            'label' => 'Brand Logo Text',
            'name' => 'ctp_tab_' . $i . '_brand_logo',
            'type' => 'text',
            'default_value' => $tab['brand_logo'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_main_image_url',
            'label' => 'Main Image URL',
            'name' => 'ctp_tab_' . $i . '_main_image_url',
            'type' => 'url',
            'default_value' => $tab['main_image_url'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_stat_value',
            'label' => 'Stat Value',
            'name' => 'ctp_tab_' . $i . '_stat_value',
            'type' => 'text',
            'default_value' => $tab['stat_value'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_stat_text',
            'label' => 'Stat Text',
            'name' => 'ctp_tab_' . $i . '_stat_text',
            'type' => 'textarea',
            'rows' => 2,
            'default_value' => $tab['stat_text'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_cta_text',
            'label' => 'CTA Text',
            'name' => 'ctp_tab_' . $i . '_cta_text',
            'type' => 'text',
            'default_value' => $tab['cta_text'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_cta_url',
            'label' => 'CTA URL',
            'name' => 'ctp_tab_' . $i . '_cta_url',
            'type' => 'url',
            'default_value' => $tab['cta_url'],
        );

        $fields[] = array(
            'key' => 'field_ctp_tab_' . $i . '_trusted_logos',
            'label' => 'Trusted Logos (one per line)',
            'name' => 'ctp_tab_' . $i . '_trusted_logos',
            'type' => 'textarea',
            'rows' => 4,
            'default_value' => $tab['trusted_logos'],
        );
    }

    acf_add_local_field_group(array(
        'key' => 'group_ctp_tabs',
        'title' => 'Custom Tabs Settings',
        'fields' => $fields,
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'custom-tabs-settings',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'ctp_register_acf_fields');


function ctp_get_tab_data($i) {
    $trusted_raw = get_field('ctp_tab_' . $i . '_trusted_logos', 'option');
    $trusted = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $trusted_raw)));

    return array(
        'label' => get_field('ctp_tab_' . $i . '_label', 'option'),
        'quote' => get_field('ctp_tab_' . $i . '_quote', 'option'),
        'name' => get_field('ctp_tab_' . $i . '_name', 'option'),
        'title' => get_field('ctp_tab_' . $i . '_title', 'option'),
        'person_image_url' => get_field('ctp_tab_' . $i . '_person_image_url', 'option'),
        'brand_logo' => get_field('ctp_tab_' . $i . '_brand_logo', 'option'),
        'main_image_url' => get_field('ctp_tab_' . $i . '_main_image_url', 'option'),
        'stat_value' => get_field('ctp_tab_' . $i . '_stat_value', 'option'),
        'stat_text' => get_field('ctp_tab_' . $i . '_stat_text', 'option'),
        'cta_text' => get_field('ctp_tab_' . $i . '_cta_text', 'option'),
        'cta_url' => get_field('ctp_tab_' . $i . '_cta_url', 'option'),
        'trusted_logos' => $trusted,
    );
}


function ctp_render_tabs_shortcode() {
    $section_title = function_exists('get_field') ? get_field('ctp_section_title', 'option') : 'Custom Tabs';

    $tabs = array();
    for ($i = 1; $i <= 5; $i++) {
        $tabs[] = ctp_get_tab_data($i);
    }

    ob_start();
    ?>
    <section class="ctp-tabs-wrap">
        <div class="ctp-tabs">
            <?php if (!empty($section_title)) : ?>
                <h2 class="ctp-section-title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>

            <div class="ctp-tabs__nav" role="tablist" aria-label="Industry tabs">
                <?php foreach ($tabs as $index => $tab) : ?>
                    <button
                        class="tab-button <?php echo $index === 0 ? 'active' : ''; ?>"
                        type="button"
                        data-tab="tab-<?php echo esc_attr($index); ?>"
                        role="tab"
                        aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                    >
                        <?php echo esc_html($tab['label']); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="ctp-tabs__panels">
                <?php foreach ($tabs as $index => $tab) : ?>
                    <div
                        class="tab-item <?php echo $index === 0 ? 'active' : ''; ?>"
                        id="tab-<?php echo esc_attr($index); ?>"
                    >
                        <div class="ctp-panel__top">
                            <div class="ctp-main-card">
                                <div class="ctp-main-card__content">
                                    <div class="ctp-quote-mark">❝</div>

                                    <div class="ctp-quote">
                                        <?php echo esc_html($tab['quote']); ?>
                                    </div>

                                    <div class="ctp-person">
                                        <?php if (!empty($tab['person_image_url'])) : ?>
                                            <div class="ctp-person__image">
                                                <img src="<?php echo esc_url($tab['person_image_url']); ?>" alt="<?php echo esc_attr($tab['name']); ?>">
                                            </div>
                                        <?php endif; ?>

                                        <div class="ctp-person__meta">
                                            <div class="ctp-person__name"><?php echo esc_html($tab['name']); ?></div>
                                            <div class="ctp-person__title"><?php echo esc_html($tab['title']); ?></div>
                                        </div>
                                    </div>

                                    <div class="ctp-brand-logo">
                                        <?php echo esc_html($tab['brand_logo']); ?>
                                    </div>
                                </div>

                                <?php if (!empty($tab['main_image_url'])) : ?>
                                    <div class="ctp-main-card__image">
                                        <img src="<?php echo esc_url($tab['main_image_url']); ?>" alt="<?php echo esc_attr($tab['label']); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="ctp-side-cards">
                                <div class="ctp-stat-card">
                                    <div class="ctp-stat-card__value"><?php echo esc_html($tab['stat_value']); ?></div>
                                    <div class="ctp-stat-card__text"><?php echo esc_html($tab['stat_text']); ?></div>
                                </div>

                                <a class="ctp-cta-card" href="<?php echo esc_url($tab['cta_url'] ?: '#'); ?>">
                                    <span class="ctp-cta-card__text"><?php echo esc_html($tab['cta_text']); ?></span>
                                    <span class="ctp-cta-card__arrow">↗</span>
                                </a>
                            </div>
                        </div>

                        <div class="ctp-trusted">
                            <div class="ctp-trusted__label">TRUSTED BY</div>
                            <div class="ctp-trusted__logos">
                                <?php foreach ($tab['trusted_logos'] as $logo) : ?>
                                    <div class="ctp-trusted__logo"><?php echo esc_html($logo); ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_tabs', 'ctp_render_tabs_shortcode');