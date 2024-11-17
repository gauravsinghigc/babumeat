	<!--footer -->
	<footer class="py-lg-3 pb-0">
		<div class="container-fluid">
			<div class="row footer-top-w3layouts">
				<div class="col-lg-3 footer-grid-w3ls">
					<div class="footer-title">
						<h3>About Us</h3>
					</div>
					<div class="footer-text">
						<img loading="lazy" src="<?php echo MAIN_LOGO; ?>" class="img-fluid mb-2">
					</div>
				</div>
				<div class="col-lg-3 footer-grid-w3ls">
					<div class="footer-title">
						<h3>Quick Links</h3>
					</div>
					<ul class="links">
						<li>
							<a href="<?php echo DOMAIN; ?>">Home</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/collection/">Collection</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/offers/">Offers</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>">About <?php echo APP_NAME; ?></a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/blogs/">Blogs</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/reviews/">Reviews</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/contact-us/">Contact Us</a>
					</ul>
				</div>
				<div class="col-lg-3 footer-grid-w3ls">
					<div class="footer-title">
						<h3>Usefull Links</h3>
					</div>
					<ul class="links">
						<li>
							<a href="<?php echo DOMAIN; ?>/web/account">My Account</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/cart">My Cart</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/privacy-policy/">Privacy Policy</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/refund-and-cancellation">Refund & Cancellations</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/terms-and-conditions">Terms & Conditions</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/enquiry">Have an Enquiry</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/faqs">F&Q's</a>
						</li>
				</div>
				<div class="col-lg-3 footer-grid-w3ls">
					<div class="footer-title">
						<h3>Contact <?php echo APP_NAME; ?></h3>
					</div>
					<div class="contact-info">
						<h4>Location :</h4>
						<p><?php echo SECURE(PRIMARY_ADDRESS, "d"); ?></p>
						<div class="phone">
							<h4>Contact :</h4>
							<p>Phone : <?php echo PRIMARY_PHONE; ?></p>
							<p>Email :
								<a href="mailto:<?php echo PRIMARY_EMAIL; ?>"><?php echo PRIMARY_EMAIL; ?></a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright-w3layouts footer-bg">
				<p class="copy-right text-center  footer-bg">&copy; <?php echo date("Y"); ?> <?php echo APP_NAME; ?>. All Rights Reserved |
					Design by
					<a href="<?php echo DEVELOPER_URL; ?>" class="text-light"> <?php echo DEVELOPED_BY; ?> </a>
				</p>
			</div>
		</div>
	</footer>
	<!-- //footer -->
	<section class="footer-fixed-actions">
		<ul>
			<li>
				<a href="https://wa.me/<?php echo PRIMARY_PHONE; ?>?text=Hello <?php echo APP_NAME; ?>, I want to know more about you and your services...." target="_blank" class="btn btn-lg app-btn mt-2 mb-1" style="font-size:2rem !important;"><i class='fa fa-whatsapp text-success'></i></a>
			</li>
		</ul>
	</section>