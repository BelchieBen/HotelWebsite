
<div class="col1">
	<h1>Evaluation of my web design</h1>
	<hr>
	<div class="row justify">
		<div class="reportParag column">
		<h2 style="margin-bottom:6px">Layout & Design</h2>
			<p style="padding-bottom: 16px;">
				While I was developing this website I was researching and following  Jakob Nielsen’s & Rolf Molich article Improving a Human-Computer Dialogue, this article outlines several design characteristics that should be used in modern websites. These characteristics aid in providing an excellent user experience for the end users and help your website grow. One of those principles is consistency in the user interface, a well designed website would be consistent with use of colour, language & layout. This consistency helps the user build trust with the website and a study preformed by SuperMonitoring stated that as much as 57% of users say that they will not recommend a website that is poorly designed (Lucas, 2015). Therefore a lot of pressure is on the design of the website and if you do not follow these design ‘rules’ you are potentially losing over half of your audience.</p>
			<br> 
			<p>
				Adding to that research shows it only takes 50 milliseconds for a user to form an opinion about your website (Gitte Lindgaard, 2011) which means your website’s landing page should be well thought out so it captures the attention of a user. I took this into consideration when building my site and made my landing side very informative and look similar to competing e-commerce sites. By doing this, immediately the user knows what type of site it is and the sites purpose. Furthermore I carried this philosophy into my navigation as well so the user would not have to hunt or learn any new conventions just to be able to use the website. All of this encourages the user to stay on the website and explore its contents.
			</p>
		</div>

		<div class="reportParag column">
			<h2 style="margin-bottom:6px">Navigation</h2>
			<p style="padding-bottom: 16px;">
				Navigation is arguably one of the most important aspects of a website, it acts as the backbone to connect all areas of the site and an open map for the user to make journeys from. Therefore I looked at other e-commerce websites like Amazon, eBay and the some competing websites like Premiere In and Darwin escapes to see how they structured their navigation. Then I opted to take what I thought to be the best aspects of each site and combined them into what is my navigation. For example I found what eBay and Amazon does with their homepages, displaying a list of products, is enticing for the user as they can see everything that is on offer right away. However I also found that the live date pickers on both Premier Inn & Darwin Escapes are very user friendly and they only show the available products which saves the user any extra headache trying to find something available for their date range. </p>
			<br> 
			<p>
				Another consideration I made when designing this website is allowing the user to backtrack their steps, this could be from a mistake in actions or mistakenly clicked on a button. The best example of this would be the remove item functionality of the users wish list and shopping basket. This choice was derived from Nielsen’s 3rd principle “User control and freedom”, another example of this being used in my website is on the admin section of the site. On every delete page I have a cancel button so admins can back out of a delete if they changed their minds or clicked by mistake. 
			</p>
		</div>
	</div>

	
	<div class="row justify">
		<div class="reportParag column">
		<h2 style="margin-bottom:6px">Colours</h2>
		<p>
			Colours are also a huge part of web design and throughout my website I have used consistent colours for common elements like buttons and headers, this consistency aids in the website looking complete & professional but also to help users recognise what certain things do  before even reading the text. An example of where I have done this is for alert boxes, if a user isn’t logged in and try to access their basket or wish list they will see an error flash up in red saying “You must log in to see your [ Basket/ Wishlist ]”. Finally it has been proven that good use of colour in websites can help in building trust in a website and establishing e-loyalty (Cyr, et al., 2010)  </p>
		<br> 
		</div>
		<div class="reportParag column">
			<h2 style="margin-bottom:6px">Works Cited</h2>
			<ol class="Citations">
				<li>
					Cyr, D., Head, M. & Larios, H., 2010. Colour appeal in website design within and across cultures: A multi-method evaluation. International journal of human-computer studies, p. 21.
				</li>
				<li>
					Gitte Lindgaard, G. F. (2011). Attention web designers: You have 50 milliseconds to make a good first impression! Behaviour & Information Technology .
				</li>
				<li>
					Lucas, C. (2015). 5 Mobile Marketing Mistakes – and How to Fix Them. Retrieved from socPub: <a target="_blank" href="https://socpub.com/articles/5-mobile-marketing-mistakes-%E2%80%93-and-how-to-fix-them-12441">https://socpub.com/articles/5-mobile-marketing-mistakes-%E2%80%93-and-how-to-fix-them-12441</a>
				</li>
			</ol>
			<br> 
		</div>
	</div>

	<h1 style="margin-bottom:0px; margin-top: 24px;">Issues I encountered</h1>
	<h4>& How they impacted the user</h4>	
	<hr>

	<div class="row justify">

		<div class="reportParag column">
			<p style="padding-bottom: 16px;">
				During the development of this website I encountered a lot of issues but thankfully I have overcame a lot of those issues and this would not impact the end user in any way, some issues I would like to highlight are around the user interaction with choosing a date they would like to book a room for. The way I have currently made the journey to book a hotel room allows the user to pick a start date, then another date picker appears for an end date, finally a button appears for them to see all the available rooms.</p>
			<br> 
			<p style="padding-bottom:  16px">
				This was quite difficult to achieve as I needed to grab those 2 dates the user selected and send them to the server, the server needs to process those dates and compare them to current room bookings, then return a list of rooms for the user to pick from.
			</p>
			<br>
			<p>
				I did all of this using ajax, which was not taught during the lectures so I had to do some research on it to understand how to achieve what I wanted. I learned the majority of ajax from their documentation https://api.jquery.com/category/ajax/ and this article https://makitweb.com/how-to-handle-ajax-request-on-the-same-page-php/ by Yogesh Singh
			</p>
		</div>
		<div class="reportParag column">
			<p style="padding-bottom: 16px;">
				However there are a select few issues that I couldn’t overcome when making this website and I firmly believe if I had more time I would be able to tackle these issues. The most noticeable issue for the user would be seeing duplicate rooms if they chose a date range and viewed the rooms available, then closed the popup window and chose a new date range. The reasoning behind this issue is the old post data remains on the server until the page is refreshed, and since the user did not refresh the page, the rooms are still displayed.   </p>
			<br> 
			<p>
				This could cause some confusion for the user and is the most noticeable bug but as soon as you leave that page and return to it, the issue is not present. Aside from that bug there isn’t any noticeable issues for the user. 
			</p>
		</div>
	</div>
</div>