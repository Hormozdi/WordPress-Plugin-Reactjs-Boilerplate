const SimpleComponentAxios = class SimpleComponentAxios extends React.Component {
  state = {
    elements: []
  };

  componentDidMount() {
    console.log(123);
    axios
      .get(backendUrl, {
        params: {
          action: "simpleComponentAxios"
        }
      })
      .then(data => {
        if (data.data) {
          this.setState({ elements: data.data });
        }
      })
      .catch(err => console.log(err));
  }

  render() {
    return (
      <ul>
        {this.state.elements.map(ele => (
          <li key={ele.id}>{ele.id} &#8594; {ele.name}</li>
        ))}
      </ul>
    );
  }
};
