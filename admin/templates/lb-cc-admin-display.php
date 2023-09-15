<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/dmilegal
 * @since      1.0.0
 *
 * @package    LB_CC
 * @subpackage LB_CC/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h1>Casino Comparison</h1>
<h2 id="shortcodes">Shortcodes</h2>
<h4 id="-compare_button-"><code>compare_button</code></h4>
<p>params:</p>
<p><code>id</code> - Id of the current post where the shortcode is displayed. (required)</p>
<p><code>title_add</code> - Custom text for the &quot;add to compare&quot; button.</p>
<p><code>title_remove</code> - Custom text for the &quot;remove from compare&quot; button.</p>
<p>usage:</p>
<p><code>do_shortcode(&#39;[compare_button id=&quot;44&quot;]&#39;)</code></p>