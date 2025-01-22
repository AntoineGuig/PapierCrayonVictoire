// Function to toggle between personal drawings and contest drawings
function voirMesDessins() {
  document.getElementById('listeMesDessins').style.display = 'block';
  document.getElementById('listeConcours').style.display = 'none';
  
  // Update button states
  document.getElementById('btn1').classList.add('active');
  document.getElementById('btn2').classList.remove('active');
}

function voirLesDessinsConcours() {
  document.getElementById('listeMesDessins').style.display = 'none';
  document.getElementById('listeConcours').style.display = 'block';
  
  // Update button states
  document.getElementById('btn1').classList.remove('active');
  document.getElementById('btn2').classList.add('active');
}

// Add event listeners when the document is loaded
document.addEventListener('DOMContentLoaded', function() {
  // Add click listeners to all contest buttons
  const concoursButtons = document.querySelectorAll('.concours-btn');
  
  concoursButtons.forEach(button => {
      button.addEventListener('click', function() {
          // Get the contest number from the data attribute
          const concoursNum = this.getAttribute('data-concours');
          const dessinsContainer = document.getElementById(`dessins-${concoursNum}`);
          
          // Toggle the display of drawings for this contest
          if (dessinsContainer.style.display === 'none') {
              // Close all other containers first
              document.querySelectorAll('.dessins-container').forEach(container => {
                  container.style.display = 'none';
              });
              // Open this container
              dessinsContainer.style.display = 'block';
              
              // Scroll the container into view smoothly
              dessinsContainer.scrollIntoView({ behavior: 'smooth' });
          } else {
              dessinsContainer.style.display = 'none';
          }
      });
  });
});