
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        
            <label for="encryptionType">Select Encryption Type:</label>
            <select id="encryptionType" name="encryptionType" onchange="toggleOptions()" >
                <option value="caesar">caesar cipher</option>        
                
                <option value="viginire">Viginire</option>
                <option value="autoKey">Auto key</option>
                <option value="affine">Affine</option>
            </select>

            <div id="optionsContainer">
                <label for="enterText">Enter Text:</label>
                <textarea id="Text" ></textarea>

                <label for="enterKey">Enter Key:</label>
                <input type="number" id="Key">

                <div id="enterKey2Container" style="display: none;">
                    <label for="enterKey2">Enter Key2:</label>
                    <input type="number" id="Key2">
                </div>
                 
                <button id="encrypt_button" onclick="Do_algo(id)">Encrypt</button>
                <button id="decrypt_button" onclick="Do_algo(id)">Decrypt</button>
                
                <label >Result:</label>
                <textarea id="result" readonly></textarea>
                <button id="copy_button" onclick="copyResult()">Copy</button>
            </div>
       
    </div>  
</body>
</html>
<script>
        function toggleOptions() {
            var selection = document.getElementById('encryptionType').value;
            var key2Container = document.getElementById('enterKey2Container');
            var keyInput = document.getElementById("Key");
            if (selection === 'affine') {
                key2Container.style.display = 'block';
            } else {
                key2Container.style.display = 'none';
            }
            if (selection === "caesar" || selection === "affine") {
                keyInput.type = "number";
               
            } else {keyInput.type = "text";}
        }

        function Do_algo (id){

        document.getElementById(id).addEventListener("click",function() {
        var select =document.getElementById("encryptionType").value;    
        var text = document.getElementById("Text").value;
        var key = document.getElementById("Key").value;
        var key2 = document.getElementById("Key2").value;
        var xhttp = new XMLHttpRequest();

        xhttp.open("GET", "manage.php?text="+ text+"&key=" + key+"&key2="+key2+"&select="+select+"&type="+id, true);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("result").innerHTML =this.responseText;
            }
        };

        xhttp.send();
        });

        }
        function copyResult() {
            var resultTextarea = document.getElementById("result");           
            resultTextarea.select();
            resultTextarea.setSelectionRange(0, 99999); // For mobile devices           
            document.execCommand("copy");          
            window.getSelection().removeAllRanges();
        }
        
    </script>
