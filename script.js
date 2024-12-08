function showForm(formPath) {
    const formContainer = document.getElementById('form-container'); // The container where the content will be loaded

    // Clear any existing content in the container
    formContainer.innerHTML = '';

    // Fetch and load the content from the PHP file
    fetch(`${formPath}.php`)
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text();
      })
      .then(html => {
        // Create a temporary container to parse the HTML content
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;

        // Move all content to the actual form container
        while (tempDiv.firstChild) {
          formContainer.appendChild(tempDiv.firstChild);
        }

        // Find and execute all inline and external scripts
        const scripts = formContainer.querySelectorAll('script');
        scripts.forEach(script => {
          const newScript = document.createElement('script');

          if (script.src) {
            // For external scripts, copy the `src` attribute
            newScript.src = script.src;
            newScript.async = false; // Ensure scripts are executed in order
          } else {
            // For inline scripts, copy the content
            newScript.textContent = script.textContent;
          }

          // Append the new script to the document to execute it
          document.body.appendChild(newScript);

          // Remove the old script element from the DOM
          script.remove();
        });
      })
      .catch(error => {
        console.error('Error loading form:', error);
        formContainer.innerHTML = '<p>Sorry, there was an error loading the content.</p>';
      });
  }