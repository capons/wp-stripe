<?php
/**
 * @var $url_exist bool
 * @var $settings array
 * @var $data array
 * @var $add_site_link string
 */
?>

<div class="wrap get-site-control">
    <div class="tool-box full-width <?php echo  ( (count($data) > 1) || !$url_exist ) ? 'site-select-multi' : 'site-select-single'; ?>">

        <?php if ( (count($data) > 1) || !$url_exist ): ?>
            <h1 class="mb30">Select site to manage widgets</h1>

            <form action="" method="POST" class="select-widget-form mb30">
                <?php wp_nonce_field(); ?>

                <div class="form-group clear">
                    <label class="control-label" for="widget">Sites</label>
                    <select id="widget" name="gsc_widget" class="form-control select-widget" required>
                        <?php if (!$url_exist): ?>
                            <option value="" data-manage="">Select a site...</option>
                        <?php endif; ?>
                        <?php foreach($data as $dataRow): ?>
                            <option <?php echo ($dataRow['id'] == $settings['widget_id']) ? 'selected' : ''; ?>
                                value="<?php echo $dataRow['id'] ?>"
                                data-manage="<?php echo $dataRow['manage_link']; ?>"
                            >
                                <?php echo $dataRow['url']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <a href="<?php echo $add_site_link; ?>" target="_blank" class="add-site button-primary">Add site</a>
                    <input type="hidden" name="gsc_update_widget" value="Update Widget" />
                </div>
            </form>
        <?php endif; ?>

        <a href="<?php echo !empty($data[0]['manage_link']) ? $data[0]['manage_link'] : 'javascript:void(0);'; ?>" class="button-primary manage-widget-link" target="_blank">Manage widgets</a>

    </div>
</div>
