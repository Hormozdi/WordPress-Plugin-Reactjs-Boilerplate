var App = class App extends React.Component {
  state = {
    values: [],
    inputValue: ""
  };

  addValue = () => {
    const values = [...this.state.values];
    values.push(this.state.inputValue);
    this.setState({ values: values });
    this.state.inputValue = "";
  };

  inputUpdate = e => {
    this.setState({
      [e.target.id]: e.target.value
    });
  };

  render() {
    return (
      <span>
        <input
          onChange={this.inputUpdate}
          id="inputValue"
          value={this.state.inputValue}
        />
        &nbsp;
        <button onClick={this.addValue}>Submit</button>
        {this.state.values.map((value, i) => (
          <div key={i}>{value}</div>
        ))}
      </span>
    );
  }
};
