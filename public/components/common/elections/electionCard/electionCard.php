<?php

class ElectionCard
{

    public function render($active_page = null)
    {

?>

    <div id = "electionCard">
        <div id = "electionCardTitle">The Election for the Union Selection 2024 is happening now....</div>
        <div id = "electionCardTime" class="text-muted" >Election ends in : 1hr 30min 4sec</div>
        <div id = "electionButton"><input type = "button" value = "VOTE NOW!"></div>
    </div>


        <style>
            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: var(--sidebar-width);
                height: 100vh;
                background-color: #fff;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                padding: 2rem;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                
                margin: 1rem;
                height: calc(100vh - 2rem);
                border-radius: 10px;
            }

            #sidebar .sidebar__logo {
                padding: 0 1rem;
                /* margin-top: 60px; */
                margin-bottom: 1.5rem;
            }

            #sidebar .sidebar__logo img {
                width: 100%;
            }

            #sidebar .sidebar__list ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            #sidebar .sidebar__list ul li {
                margin-bottom: 10px;
            }
            
            #sidebar .sidebar__list ul li a {
                display: block;
                color: #000;
                text-decoration: none;
                font-size: var(--rv-1-125);
                font-weight: 500;
                padding: 0.75rem 1.25rem;


                border-radius: 10px;
                transition: all 0.3s ease-in-out;

                /* display: flex;
                align-items: center; */
                
            }
            #sidebar .sidebar__list ul li i {
                margin-right: 0.5rem;
                
            }

            #sidebar .sidebar__list ul li.active a,
            #sidebar .sidebar__list ul li a:hover {
                color: #fff;
                background-color: yellowgreen;
                background-color: #2684FF;

                /* shadow bottom right */
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
            }
            

            #sidebar .fixed__bottom {
                font-size: 0.8rem;
                color: #000;
                text-align: center;
            }

            #sidebar .fixed__bottom a {
                color: #000;
                text-decoration: underline;
            }

            #sidebar .fixed__bottom a:hover {
                color: #000;
            }

            #sidebar .spacer {
                flex-grow: 1;
            }

            #electionCard {
                display : flex;
                flex-direction : column;
                
                margin : 10px;
                margin-left : 20px;
                width: 800px;
                height: 90px;
                flex-shrink: 0;
                border-radius : 10px;
                border: 2px solid rgba(38, 132, 255, 0.41);
                
            }

            #electionCardTitle{
                padding : 10px 10px 5px;
                color: #2684FF;
                font-family: Inter;
                font-size: 16px;
                font-weight: 500;
            }

            #electionCardTime{
                font-size : 12px;
                padding-left : 10px;
            }

            #electionButton{
                align-self: flex-end;
                padding-right : 10px;
                padding-bottom : 10px;
            }

            #electionButton input{
                padding-right : 10px;
                border-radius: 10px;
                background: #2684FF;
                color : white;
                border : none;
                font-size : 14px;
                padding : 8px;
            }

            #electionButton input:hover{
                cursor: pointer;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                
            }

        </style>

<?php

    }
}
