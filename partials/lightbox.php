<?php
/**
 * Photo lightbox (native <dialog>: focus trap and Escape handled by the browser).
 *
 * @package Super_Healthcare
 */

defined( 'ABSPATH' ) || exit;
?>
<dialog class="lightbox" id="lightbox" aria-label="Photo viewer">
  <figure class="lightbox-figure">
    <img class="lightbox-img" src="" alt="">
    <figcaption class="lightbox-caption"></figcaption>
  </figure>
  <button type="button" class="lightbox-btn lightbox-prev" aria-label="Previous photo">&#8249;</button>
  <button type="button" class="lightbox-btn lightbox-next" aria-label="Next photo">&#8250;</button>
  <button type="button" class="lightbox-close" aria-label="Close photo viewer">&times;</button>
</dialog>
