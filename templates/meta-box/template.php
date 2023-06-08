
<style>
<?php include dirname( __FILE__ ) . '/styles.css'; ?>
</style>

<div class="just-seo-widget">

    <div class="field">
        <label for="just_seo_robots">Robots</label>
        <select name="just_seo_robots">
            <!-- TODO render the selected option -->
            <option>index, follow</option>
            <option>noindex, nofollow</option>
        </select>
    </div>

    <div class="field">
        <label for="just_seo_canonical">Canonical URL</label>
        <input 
            name="just_seo_canonical" 
            typ="url"
            value="<?php echo esc_attr( $seo_model->get_canonical() ); ?>">
    </div>

    <div class="field">
        <label for="just_seo_desc">Meta Description</label>
        <textarea 
            name="just_seo_desc"
            placeholder="<?php echo esc_html( get_the_excerpt() ) ?>"
        ><?php echo esc_attr( $seo_model->get_desc() ); ?></textarea>
    </div>

</div>
