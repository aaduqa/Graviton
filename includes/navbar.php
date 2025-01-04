<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Navigation Bar</title>
</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
nav {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 75px;
    background: var(--nav-color);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    z-index: 50;
}
.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 100%;
    max-width: 90%;
    margin: auto;
}

.navLogo {
    display: flex;
    align-items: center;
    
}
.navLogo img {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: -7px;
    padding: 5px;
}
.navbar .menu {
    display: flex;
    align-items: center;
}
.navbar .menu li {
    list-style: none;
    margin: 0 20px;
    position: relative;
}
.navbar .menu li a {
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.navbar .menu li a:hover {
    color: #FFD700;
    text-shadow: 1px 1px 5px rgba(255, 255, 0.2, 0.2);
}
.dropdown .dropbtn::after {
    content: '\25BC';
    font-size: 12px;
    color: #fff;
    margin-left: 10px;
    transition: transform 0.3s ease;
}
.dropdown:hover .dropbtn::after {
    transform: rotate(180deg);
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: var(--nav-color);
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}
.dropdown-content a {
    color: #fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-size: 16px;
    font-weight: 500;
}
.dropdown-content a:hover {
    background: var(--nav-color);
    box-shadow: 5px 8px 16px rgba(0, 0, 0, 0.2);
    color: #FFD700;
}
.dropdown:hover .dropdown-content {
    display: block;
}
.darkLight-searchBox {
    display: flex;
    align-items: center;
}
.dark-light {
    display: flex;
    align-items: center;
}
.logo-link {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
}
.navLogo a {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    color: #fff;
    text-decoration: none;
    font-size: 26px;
    letter-spacing: 1px;
    transition: color 0.3s ease, text-shadow 0.3s ease;
}
.navLogo a:hover {
    color: #FFD700;
    text-shadow: 2px 2px 8px rgba(255, 255, 255, 0.2);
}
</style>

<body>
    <nav>
        <div class="navbar">
            <span class="navLogo">
                <img src="graviton_logo.png" alt="Logo"> 
                <a href="home.php">GRAVITON</a>
            </span>
            <ul class="menu">
                <li><a href="home.php">Home</a></li>
                <li class="dropdown">
                    <a href="workshopindex.php" class="dropbtn">Workshop Feedback</a>
                    <div class="dropdown-content">
                        <a href="workshop_history.php">Feedback History</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="projectindex.php" class="dropbtn">Internship Progress</a>
                    <div class="dropdown-content">
                        <a href="projecthistory.php">Progress History</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a class="dropbtn">Materials</a>
                    <div class="dropdown-content">
                        <a href="https://docs.google.com/spreadsheets/d/14XVo-uRFu-x5UaMN4ABGLFdPQ2DjOv3O954gHVeru3g/edit?gid=1014698623#gid=1014698623">Packing List</a>
                        <a href="https://docs.google.com/spreadsheets/d/1UNLjzkB7A-RvhRDIcK7kjCwZfANgqzzY0eV_S8o3UKU/edit?usp=sharing">Compiled Packing List</a>
                    </div>
                    </li>
                    </li>
    <li><a href="https://drive.google.com/drive/folders/1ivsZyOio_rt9j9ophC_JLVU9U7lFmrn6">Photos/Videos</a></li>
    <li><a href="calendar.php">Upcoming Workshops</a></li>
    <li><a href="attendance.php">Attendance</a></li>
</ul>
            
            </div>
        </div>
    </nav>

    
</body>
</html>
