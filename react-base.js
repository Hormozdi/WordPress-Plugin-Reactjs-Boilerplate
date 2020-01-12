const renderElements = [
    {component: <App />, el: "my-app"}
];

let domElement = null;
renderElements.forEach(element => {
    if ( domElement = document.getElementById(element.el) ) {
        ReactDOM.render(element.component, domElement);
    }
});
