/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import {CollectionBasicType} from "./admin/CollectionBasicType";


if (document.querySelectorAll('.add-question-link')) {
    window.addEventListener('click', function (e) {
        console.log('salut')
        let collectionBasicType = new CollectionBasicType(document.querySelector('.add-question-link'));

    });
    let collectionBasicType = new CollectionBasicType(document.querySelector('.add-question-link'));
}