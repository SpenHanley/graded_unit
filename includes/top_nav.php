<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="shop.php">Shop</a>
                    </li>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                     <li>
                        <a href="checkout.php">Checkout</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <?php
                      if (isset($_SESSION['admin'])) {
                        echo '<li>
                        <a href="admin">Admin</a>
                        </li>';
                      }
                      if (!isset($_SESSION['username'])) {
                        echo '<li>
                        <a href="login.php">Login</a>
                        </li>';
                        echo '<li>
                          <a href="register.php">Register</a>
                        </li>'; 
                      } else {
                        echo '<li>
                        <a href="logout.php">Logout</a>
                        </li>'; 
                      }
                    ?>
                </ul>
            </div>
