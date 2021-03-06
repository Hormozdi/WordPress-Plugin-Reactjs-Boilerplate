//data that generated by php
const backendUrl = base_data.ajaxurl;

jQuery(document).ready(function() {
  //list of main components
  const renderElements = [
    { component: <SimpleComponent />, el: "simple-component" },
    { component: <SimpleComponentAxios />, el: "simple-component-axios" }
  ];

  //loop for generate components if selected dom element is exists
  let domElement = null;
  renderElements.forEach(element => {
    if ((domElement = document.getElementById(element.el))) {
      ReactDOM.render(element.component, domElement);
    }
  });
});
