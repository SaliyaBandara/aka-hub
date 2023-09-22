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
