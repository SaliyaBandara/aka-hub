<?php

class PrevElectionCard
{

    public function render($active_page = null)
    {

?>

    <div id = "prevElectionCard">
        <div id = "prevElectionCardTitle">IEEE Day date confirmation - Poll</div>
        <div id = "prevElectionCardTime" class="text-muted" >Poll ended : 5th July 2023</div>
        <div id = "prevEelectionButton"><input type = "button" value = "View Results"></div>
    </div>


        <style>
            
            #prevElectionCard {
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

            #prevElectionCardTitle{
                padding : 10px 10px 5px;
                color: #2684FF;
                font-family: Inter;
                font-size: 16px;
                font-weight: 500;
            }

            #prevElectionCardTime{
                font-size : 12px;
                padding-left : 10px;
            }

            #prevEelectionButton{
                align-self: flex-end;
                padding-right : 10px;
                padding-bottom : 10px;
            }

            #prevEelectionButton input{
                padding-right : 10px;
                border-radius: 10px;
                background: #2684FF;
                color : white;
                border : none;
                font-size : 14px;
                padding : 8px;
            }

            #prevEelectionButton input:hover{
                cursor: pointer;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                
            }

        </style>

<?php

    }
}
