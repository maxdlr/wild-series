/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap');

console.log('Hello Webpack Encore')

const categoryDdButton = document.getElementById('dropdownMenuButton');
const categoryDdMenu = document.getElementById('dropdownMenu')

function addCategory(categories) {

    const categoriesList = document.createElement('ul');
    categoryDdMenu.append(categoriesList);
    
    for (const category of categories) {

        let categoryDdItem = document.createElement('li');
        categoryDdItem.innerHTML = category;
        
        categoriesList.append(categoryDdItem);
    }

}

categoryDdButton.addEventListener('click', function(){
    fetch('/get-categories')
    .then(response => response.json())
    .then(data => addCategory(data))
    .catch(err => alert('fetch error'));
})
