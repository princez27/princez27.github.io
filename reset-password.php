

	<main>
		<div class="wrapper-main">
			<section class="section-default">
				<h1>Reset your Password</h1>
				<p>An email will be sent to you</p>
				<form action="reset-request.inc.php" method="post">
					<input type="text" name="email" placeholder="Enter Email">
					<button type="submit" name="reset-request-submit">Recieve new password by mail</button>
				</form>
				<?php
					if(isset($_GET["reset"])){
						if($_GET["reset"] == "success"){
							echo '<p class="signupsuccess">Check email!</p>';
						}
					}
				?>
			</section>
		</div>
	</main>

