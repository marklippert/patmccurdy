      <?php if (!isset($Sidebar)) { ?>
      </div> <!-- /#main -->
        <div id="sidebar">
          <div id="icons">
            <a href="https://venmo.com/Pat-McCurdy-2" aria-label="Venmo" class="icon venmo"></a>
            
            <form id="donation" name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="new">
              <div>
                <input type="hidden" name="cmd" value="_donations">
                <input type="hidden" name="business" value="patmccurdy123@yahoo.com">
                <input type="hidden" name="item_name" value="Pat McCurdy Tip">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="amount" value="">
                <input type="submit" name="submit" value="" aria-label="PayPal" class="icon paypal">
              </div>
            </form>

            <a href="https://www.facebook.com/HeyPaddy/" aria-label="Facebook" class="icon facebook"></a>

            <a href="https://bsky.app/profile/patmccurdy.bsky.social" aria-label="Bluesky" class="icon bluesky"></a>
            
            <a href="https://www.instagram.com/pat_mccurdy/" aria-label="Instagram" class="icon instagram"></a>

            <a href="https://www.youtube.com/user/OfficialPatMcCurdy" aria-label="YouTube" class="icon youtube"></a>

            <a href="https://twitter.com/PatMcCurdy" aria-label="Twitter" class="icon twitter"></a>

            <a rel="me" href="https://mastodon.social/@patmccurdy" aria-label="Mastodon" class="icon mastodon"></a>

            <a href="https://music.apple.com/us/artist/pat-mccurdy/388968174" aria-label="Apple" class="icon apple"></a>

            <a href="https://www.amazon.com/Pat-McCurdy/e/B001LH3PCQ/digital/" aria-label="Amazon" class="icon amazon"></a>

            
          </div> <!-- /#icons -->
          
          <h2>Hire <span>Pat</span></h2>
          Email <a href="mailto:fatmurf@wi.rr.com">Murf</a> or call 414-916-4914. Be sure to include the date, time of day, and location of the potential show to get an accurate price quote.
        </div> <!-- /#sidebar -->
      </div> <!-- /#main-sidebar -->
      <?php } ?>

    </div> <!-- /#content -->

    <footer class="site-width">
      Copyright &copy; 1995-<?php echo date("Y"); ?> Pat McCurdy &middot; All rights reserved
    </footer>

    <script>
      // Open external link and PDFs in new tab
      [...document.links].forEach(link => {
        if (link.hostname != window.location.hostname || link.href.split('.').pop() == "pdf") {
          link.target = '_blank'; link.rel = 'noopener';
        }
      });
    </script>

  </body>
</html>