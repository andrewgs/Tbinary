<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<?php $this->load->view("users_interface/includes/head");?>
<body>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="container">
		<?php $this->load->view("users_interface/includes/header");?>
		<div id="main">
			<p class="slogan">Join the most <em>advanced, trusted and reliable</em> trading platform</p>
			<div class="row">
				<div id="container" class="span18"> </div>
				<div class="span6">
					<ul class="switcher">
						<li><a class="switcher__active" href="#real-signup"><span>Real Trade</span></a></li>
						<li><a href="#demo-signup"><span>Demo Trade</span></a></li>
					</ul>
					<div class="signup-form" id="real-signup">
						<?php $this->load->view("forms/formrealregister");?>
					</div>
					<div class="signup-form" id="demo-signup">
						<?php $this->load->view("forms/formdemoregister");?>
					</div>
				</div>
			</div><!-- /charts and sign up forms -->
			<div class="row">
				<div class="span18">
					<div class="ticker">
						<div class="row">
							<div class="span3">
								<select>
									<option value="USD/JPY">USD/JPY</option>
								</select>
							</div>
							<div class="span3">
								<div class="payout">Payout <span>65%</span></div>
								<span>Amount, $</span>
								<input value="1" type="text" />
							</div>
							<div class="span4 payouts">
								<span>Winning payout</span>
								<span class="win-payout">$1.65</span>
								<span>Minimum payout</span>
								<span class="min-payout">$0.15</span>
							</div>
							<div class="span4">
								<a href="#" class="btn btn-above">above</a>
								<div class="leverage">82.<span>38</span></div>
								<a href="#" class="btn btn-below">below</a>
							</div>
							<div class="span4">
								<div class="timer stop">00:08</div>
								<a href="#" class="btn btn-action invest">Invest</a>
							</div>
						</div>
					</div>
					<div class="ticker">
						<div class="row">
							<div class="span3">
								<select>
									<option value="USD/JPY">USD/JPY</option>
								</select>
							</div>
							<div class="span3">
								<div class="payout">Payout <span>63%</span></div>
								<span>Amount, $</span>
								<input value="1" type="text" />
							</div>
							<div class="span4 payouts">
								<span>Winning payout</span>
								<span class="win-payout">$1.63</span>
								<span>Minimum payout</span>
								<span class="min-payout">$0.15</span>
							</div>
							<div class="span4">
								<a href="#" class="btn btn-above">above</a>
								<div class="leverage">106.<span class="up">88</span></div>
								<a href="#" class="btn btn-below">below</a>
							</div>
							<div class="span4">
								<div class="timer stop">00:03:48</div>
								<a href="#" class="btn btn-action invest">Invest</a>
							</div>
						</div>
					</div>
					<div class="ticker">
						<div class="row">
							<div class="span3">
								<select>
									<option value="USD/JPY">USD/JPY</option>
								</select>
							</div>
							<div class="span3">
								<div class="payout disabled">Payout <span>65%</span></div>
								<span>Amount, $</span>
								<input value="1" type="text" />
							</div>
							<div class="span4 payouts">
								<span>Winning payout</span>
								<span class="win-payout">$1.65</span>
								<span>Minimum payout</span>
								<span class="min-payout">$0.15</span>
							</div>
							<div class="span4">
								<a href="#" class="btn btn-above">above</a>
								<div class="leverage">132.<span class="up">11</span></div>
								<a href="#" class="btn btn-below">below</a>
							</div>
							<div class="span4">
								<div class="timer stop">00:02:27</div>
								<a href="#" class="btn btn-action invest disabled">Invest</a>
							</div>
						</div>
					</div>
				</div>
				<div class="span6"> 
					<h3 class="main">How to trade options</h3>
					<ol>
						<li>Pick the option you believe will rise or fall to the target price.</li>
						<li>
							Simply press the ABOVE button if you believe that the value will exceed the listed 
							price at expiration, or press the BELOW button if you feel that the value will decline 
							below the listed price at expiration.
						</li>
						<li>Insert your initial investment sum and press the Apply button.</li>
						<li>Gain up to 75% of your investment.</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="gray-bg">
		<div class="container">
			<div class="row">
				<div class="span24 heading">
					<h2 class="main">Tbinary trading platform features</h2>
				</div>
				<div class="span8">
					<p><strong>A quick and simple way to enter the world of online trading</strong></p>
					<ul>
						<li>Breaking market news straight to your inbox</li>
						<li>Trade 24/7 with One Touch Options</li>
						<li>Flexible trades with Rollover and Double-ups tools</li>
					</ul>
				</div>
				<div class="span8">
					<p><strong>All the tools you need to trade binary options with confidence</strong></p>
					<ul>
						<li>24/7 Support</li>
						<li>See what thousands of others are trading</li>
						<li>Free Trader's E-Guide</li>
						<li>Market Reviews</li>
					</ul>
				</div>
				<div class="span8">
					<p><strong>Probably the most advanced trading platform with one touch options</strong></p>
					<ul>
						<li>Largest selection of assets and options</li>
						<li>No commissions, no hidden fees</li>
						<li>Easy and fast withdrawal</li>
						<li>1 pip and you are in the money!</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="try-now">
		<div class="container">
			<div class="row">
				<div class="span18">
					<p class="caption">Check out the features below, or go ahead and sign up.</p>
				</div>
				<div class="span6">
					<a href="#" class="btn btn-action">Start trade now</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="span24">
				<p>
					With so many binary options brokers available today it's hard to decide which company to trade with. 
					Tbinary was the first of many online binary options brokers to go live. Tbinary was also the first 
					company to offer stock options trading as part of a complete binary options trading system. We have 
					a well established binary options system that reviews all of the financial markets to help you make 
					the best investment possible. All of our investors can take advantage of our in depth tutorial which 
					will teach you how to trade with our system and adhere to the advice given on the site. We always tell 
					our investors to trade carefully and responsibly. We recommend not to invest money which you cannot 
					afford to forfeit. Tbinary does not accept or take any legal responsibility and is not liable for 
					any trades made by our investors.
				</p>
				<p>
					Extensive Range of Assets - Tbinary is a binary options trading platform that gives its users a variety 
					of binary options on over 50 underlying assets, including forex binary options. The following range of 
					assets is available on the Tbinary platform: 20 indices, 17 stocks, 12 currencies and 4 commodities. 
				</p>
			</div>
		</div>
	</div>
	<?php $this->load->view("users_interface/includes/footer");?>
	<?php $this->load->view("users_interface/includes/copyright");?>
	<?php $this->load->view("users_interface/includes/scripts");?>
	<script src="<?=$baseurl;?>js/main.js"></script>
	<script type="text/javascript">
		$(function(){
			$("ul.switcher li a").click(function(e){e.preventDefault();$("ul.switcher li a").removeClass('switcher__active');$(this).addClass('switcher__active');
				$("div.signup-form:visible").hide();var elem_id = $(this).attr('href');$(elem_id).show();});
		});
	</script>
</body>
</html>
