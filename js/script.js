function checkboxChangeColor() {
    var checkbox = document.getElementsByName("skill");
    var container = document.getElementsByClassName("skill");

    for (var check = 0; check < checkbox.length; check++) {
        if (checkbox[check].checked) {
            container[check].style.backgroundColor = "var(--red)";
        }
        else {
            container[check].style.backgroundColor = "var(--darker-gray)";
        }
    }
}


function convertToIndicNumbers(className) {
    const elements = document.querySelectorAll(`.${className}`);
  
    elements.forEach(element => {
      const textContent = element.textContent;
      let indicNumbers = "";
      for (let i = 0; i < textContent.length; i++) {
        const char = textContent.charAt(i);
        if (/\d/.test(char)) {
          const digit = parseInt(char, 10); // Convert digit to number
          indicNumbers += String.fromCharCode(digit + 1632);
        } else {
          indicNumbers += char; // Keep other characters unchanged
        }
      }
      element.textContent = indicNumbers;
    });
  }
  
  
  