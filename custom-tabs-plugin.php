<?php
/**
 * Plugin Name: Custom Tabs Plugin
 * Description: A shortcode-based custom tabs component.
 * Version: 1.0.0
 * Author: Eric Feldman
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CTP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CTP_PLUGIN_PATH', plugin_dir_path(__FILE__));

function ctp_enqueue_assets() {
    wp_enqueue_style(
        'ctp-proxima-nova',
        'https://use.typekit.net/wuz0gtr.css',
        array(),
        null
    );

    wp_enqueue_style(
        'ctp-styles',
        CTP_PLUGIN_URL . 'assets/css/custom-tabs.css',
        array('ctp-proxima-nova'),
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
add_action('wp_enqueue_scripts', 'ctp_enqueue_assets');

function ctp_get_tabs_data() {
    return array(
        array(
            'id' => 'retail',
            'label' => 'Retail',
            'quote' => 'Riskified has enabled safe, fast, and seamless payments throughout our collaboration. We’re excited to see what opportunities we can unlock in the future.',
            'name' => 'Michael Fleisher',
            'title' => 'Chief Financial Officer',
            'brand_logo' => 'wayfair',
            'person_image' => 'https://via.placeholder.com/72',
            'main_image' => 'https://via.placeholder.com/520x520',
            'stat_value' => '50%',
            'stat_text' => 'Reduction in the cost of fraud',
            'cta_text' => 'Read Wayfair case study',
            'cta_url' => '#',
            'trusted_by' => array('COSTWAY', 'ROOMS TO GO', 'ALDO', 'bluemercury'),
        ),
        array(
            'id' => 'luxury-fashion',
            'label' => 'Luxury fashion',
            'quote' => 'Luxury fashion brands use Riskified to deliver safer, smoother transactions while protecting the customer experience.',
            'name' => 'Jane Doe',
            'title' => 'VP of Ecommerce',
            'brand_logo' => 'brand',
            'person_image' => 'https://via.placeholder.com/72',
            'main_image' => 'https://via.placeholder.com/520x520',
            'stat_value' => '32%',
            'stat_text' => 'Reduction in fraudulent orders',
            'cta_text' => 'Read luxury case study',
            'cta_url' => '#',
            'trusted_by' => array('Brand A', 'Brand B', 'Brand C', 'Brand D'),
        ),
        array(
            'id' => 'digital-goods',
            'label' => 'Digital goods',
            'quote' => 'Digital goods companies need speed and precision, and Riskified helps balance approval rates with protection.',
            'name' => 'John Smith',
            'title' => 'Head of Payments',
            'brand_logo' => 'brand',
            'person_image' => 'https://via.placeholder.com/72',
            'main_image' => 'https://via.placeholder.com/520x520',
            'stat_value' => '18%',
            'stat_text' => 'Increase in approval rate',
            'cta_text' => 'Read digital case study',
            'cta_url' => '#',
            'trusted_by' => array('Brand E', 'Brand F', 'Brand G', 'Brand H'),
        ),
        array(
            'id' => 'travel',
            'label' => 'Travel',
            'quote' => 'Travel merchants rely on Riskified to reduce friction for good customers while preventing costly abuse.',
            'name' => 'Sarah Lee',
            'title' => 'Director of Payments',
            'brand_logo' => 'brand',
            'person_image' => 'https://via.placeholder.com/72',
            'main_image' => 'https://via.placeholder.com/520x520',
            'stat_value' => '41%',
            'stat_text' => 'Lower fraud-related losses',
            'cta_text' => 'Read travel case study',
            'cta_url' => '#',
            'trusted_by' => array('Brand I', 'Brand J', 'Brand K', 'Brand L'),
        ),
        array(
            'id' => 'athletic-outdoors',
            'label' => 'Athletic & Outdoors',
            'quote' => 'Athletic and outdoor brands use Riskified to strengthen fraud prevention without sacrificing conversion.',
            'name' => 'Alex Brown',
            'title' => 'CFO',
            'brand_logo' => 'brand',
            'person_image' => 'https://via.placeholder.com/72',
            'main_image' => 'https://via.placeholder.com/520x520',
            'stat_value' => '27%',
            'stat_text' => 'Decrease in chargebacks',
            'cta_text' => 'Read athletic case study',
            'cta_url' => '#',
            'trusted_by' => array('Brand M', 'Brand N', 'Brand O', 'Brand P'),
        ),
    );
}

function ctp_render_tabs_shortcode() {
    $tabs = ctp_get_tabs_data();

    if (empty($tabs)) {
        return '';
    }

    ob_start();
    ?>
    <section class="ctp-tabs-wrap">
        <div class="ctp-tabs">
            <h2 class="ctp-section-title">Custom Tabs</h2>

            <div class="ctp-tabs__nav" role="tablist" aria-label="Industry tabs">
                <?php foreach ($tabs as $index => $tab) : ?>
                    <button
                        class="tab-button <?php echo $index === 0 ? 'active' : ''; ?>"
                        type="button"
                        data-tab="<?php echo esc_attr($tab['id']); ?>"
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
                        id="<?php echo esc_attr($tab['id']); ?>"
                    >
                        <div class="ctp-panel__top">
                            <div class="ctp-main-card">
                                <div class="ctp-main-card__content">
                                    <div class="ctp-quote-mark">❝</div>

                                    <div class="ctp-quote">
                                        <?php echo esc_html($tab['quote']); ?>
                                    </div>

                                    <div class="ctp-person">
                                        <div class="ctp-person__image">
                                            <img src="<?php echo esc_url($tab['person_image']); ?>" alt="<?php echo esc_attr($tab['name']); ?>">
                                        </div>

                                        <div class="ctp-person__meta">
                                            <div class="ctp-person__name"><?php echo esc_html($tab['name']); ?></div>
                                            <div class="ctp-person__title"><?php echo esc_html($tab['title']); ?></div>
                                        </div>
                                    </div>

                                    <div class="ctp-brand-logo">
                                        <?php echo esc_html($tab['brand_logo']); ?>
                                    </div>
                                </div>

                                <div class="ctp-main-card__image">
                                    <img src="<?php echo esc_url($tab['main_image']); ?>" alt="<?php echo esc_attr($tab['label']); ?>">
                                </div>
                            </div>

                            <div class="ctp-side-cards">
                                <div class="ctp-stat-card">
                                    <div class="ctp-stat-card__value"><?php echo esc_html($tab['stat_value']); ?></div>
                                    <div class="ctp-stat-card__text"><?php echo esc_html($tab['stat_text']); ?></div>
                                </div>

                                <a class="ctp-cta-card" href="<?php echo esc_url($tab['cta_url']); ?>">
                                    <span class="ctp-cta-card__text"><?php echo esc_html($tab['cta_text']); ?></span>
                                    <span class="ctp-cta-card__arrow">↗</span>
                                </a>
                            </div>
                        </div>

                        <div class="ctp-trusted">
                            <div class="ctp-trusted__label">TRUSTED BY</div>

                            <div class="ctp-trusted__logos">
                                <?php foreach ($tab['trusted_by'] as $logo) : ?>
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