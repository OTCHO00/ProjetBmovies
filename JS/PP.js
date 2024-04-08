let profilPics = document.querySelectorAll(".profil-pic");
        let inputFiles = document.querySelectorAll(".input-file");

        inputFiles.forEach((inputFile, index) => {
            inputFile.onchange = function() {
                profilPics[index].src = URL.createObjectURL(inputFile.files[0]);
            };
        });