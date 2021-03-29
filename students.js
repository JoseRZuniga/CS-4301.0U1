Survey
    .StylesManager
    .applyTheme("default");

    var json = {
    title: "Student Quiz",
    showTimerPanel: "top",
    startSurveyText: "Start Quiz",
    pages: [
        {
            questions: [
                {
                    type: "html",
                    html: "You are about to start quiz for usage and statistics.<br/>Please click on <b>'Start Quiz'</b> button when you are ready."
                }
            ]
        }, {
            questions: [
                {
                    type: "radiogroup",
                    name: "q1",
                    title: "What is your classification?",
                    choices: [
                        "Freshman", "Sophomore", "Junior", "Senior", "Graduate"
                    ]
                }
            ]
        }, {
            questions: [
                {
                    type: "radiogroup",
                    name: "q2",
                    title: "What school are you in?",
                    choices: [
                        "School of Natural Sciences and Mathematics", "Naveen Jindal School of Management", "Erik Jonsson School of Engineering and Computer Science", "School of Economic, Political and Policy Sciences", "School of Behavioral and Brain Sciences", "School of Arts, Technology, and Emerging Communication", "School of Arts and Humanities", "School of Interdisciplinary Studies"
                    ],
                    correctAnswer: "Patrick Henry"
                }
            ]
        },{
            questions: [
                {
                    type: "radiogroup",
                    name: "q3",
                    title: "If classes were to go in person this fall, how likely are you take class.",
                    choices: [
                        "Extremely likely", "Somewhat likely", "Neither likely nor unlikely", "Somewhat unlikely", "Extremely unlikely"
                    ]
                }
            ]
        },{
            questions: [
                {
                    type: "radiogroup",
                    name: "q4",
                    title: "If classes were to go online this fall, how likely are you take class.",
                    choices: [
                        "Extremely likely", "Somewhat likely", "Neither likely nor unlikely", "Somewhat unlikely", "Extremely unlikely"
                    ]
                    
                }
            ]
        },{
            questions: [
                {
                    type: "radiogroup",
                    name: "q5",
                    title: "If classes were to go online this fall, how likely are you take a gap semester",
                    choices: [
                        "Extremely likely", "Somewhat likely", "Neither likely nor unlikely", "Somewhat unlikely", "Extremely unlikely"
                    ]
                }
            ]
        },{
            questions: [
                {
                    type: "radiogroup",
                    name: "q6",
                    title: "If classes were to go online this fall, how likely are you take class at community college.",
                    choices: [
                        "Extremely likely", "Somewhat likely", "Neither likely nor unlikely", "Somewhat unlikely", "Extremely unlikely"
                    ]
                }
            ]
        }
    ],

};
window.survey = new Survey.Model(json);
survey
    .onComplete
    .add(function (result) {
        document
            .querySelector('#surveyResult')
            .textContent = "Result JSON:\n" + JSON.stringify(result.data, null, 3);
    });

$("#surveyElement").Survey({model: survey});