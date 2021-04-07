/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

let addQuestionButton = document.querySelector('.add-question-link');
let questionList = document.querySelector(addQuestionButton.getAttribute('data-collection-holder-class'));
let questionPrototype = questionList.getAttribute('data-prototype').valueOf();

addQuestionButton.addEventListener('click', function (e) {
    let counter = questionList.getAttribute('data-widget-counter').valueOf();
    counter++;
    let newQuestion = document.createElement('div');
    questionPrototype.replaceAll('__question_prototype__', counter);
    newQuestion.innerHTML = questionPrototype;
    questionList.setAttribute('data-widget-counter', counter);
    questionList.append(newQuestion);

    let addReponseButton = newQuestion.querySelector('.add-reponse-link');
    let reponseList = newQuestion.querySelector(addReponseButton.getAttribute('data-collection-holder-class'));
    let reponsePrototype = reponseList.getAttribute('data-prototype').valueOf();
    addReponseButton.addEventListener('click', function (e) {
        let reponseCounter = reponseList.getAttribute('data-widget-counter').valueOf();
        reponseCounter++;
        let newReponse = document.createElement('div');
        reponsePrototype.replaceAll('__reponse_prototype__', reponseCounter);
        newReponse.innerHTML = reponsePrototype;
        reponseList.setAttribute('data-widget-counter', reponseCounter);
        reponseList.append(newReponse);
    });
});