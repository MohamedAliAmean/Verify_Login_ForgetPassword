<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Gallery</title>
    <style>
        :root {
            --primary: #8B4513;
            --secondary: #DAA520;
            --light: #FFF8E7;
            --dark: #3C2F2F;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--light);
            color: var(--dark);
        }

        header {
            background: linear-gradient(to right, var(--dark), var(--primary));
            padding: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--light);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .gallery-container {
            width: 100%;
            overflow: hidden;
            position: relative;
            height: 400px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            background: white;
        }

        .gallery {
            display: flex;
            animation: scroll 15s linear infinite;
        }

        .gallery img {
            width: 300px;
            height: 400px;
            object-fit: cover;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .statement {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin: 20px 0;
            color: var(--primary);
            text-transform: uppercase;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        footer {
            background: var(--dark);
            color: var(--light);
            text-align: center;
            padding: 1rem;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .gallery-container {
                height: 300px;
            }

            .gallery img {
                width: 200px;
                height: 300px;
            }

            .statement {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="navbar-brand">Coffee Gallery</div>
        </nav>
    </header>

    <main>
        <div class="gallery-container">
            <div class="gallery">
                <?php
                include_once("mysqlconnection.php");

                try {
                    // get the photo of product from the DB
                    $stmt = $pdo->query("SELECT profile_image FROM User");
                    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($images)) {
                        foreach ($images as $row) {
                            echo "<img src='" . htmlspecialchars($row['profile_image']) . "' alt='User Profile Image'>";
                        }
                        // Repeate the photo 
                        foreach ($images as $row) {
                            echo "<img src='" . htmlspecialchars($row['profile_image']) . "' alt='User Profile Image'>";
                        }
                    } else {
                        echo "<p>No images found in the database.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p>Database error: " . $e->getMessage() . "</p>";
                }

                ?>
            </div>
        </div>
        <div class="statement">Check your mail</div>
    </main>

    <footer>
        <p>© 2025 Coffee Gallery. All rights reserved.</p>
    </footer>

    <script>
        const gallery = document.querySelector('.gallery');
        gallery.addEventListener('mouseover', () => {
            gallery.style.animationPlayState = 'paused';
        });
        gallery.addEventListener('mouseout', () => {
            gallery.style.animationPlayState = 'running';
        });
    </script>
</body>

</html>