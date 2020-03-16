import React, {Component, Fragment} from 'react'
import ReactDOM from 'react-dom'

import SideSectionComponent from './../general/SideSectionComponent'
import PopupSelectComponent from "./ui/PopupSelectComponent";

export default class SimpleComponent extends Component {

    constructor(props) {
        super(props);

        this.state = {
            selected: [],
            isShowingPopup: false
        };
    }

    updateSelected(options) {
        this.setState({ selected: options });
    }

    showPopup() {
        this.setState({ isShowingPopup: true });
    }

    closePopup() {
        this.setState({ isShowingPopup: false });
    }

    render() {
        const originalOptions = this.props.select.querySelectorAll('option');
        const options = [];
        const isMultiple = this.props.select.getAttribute('multiple') !== null;
        const name = this.props.select.getAttribute('name');
        const placeholder = this.props.select.getAttribute('placeholder');
        const {selected}  = this.state;

        for (let i = 0; i < originalOptions.length; i++) {
            let option = originalOptions[i];
            options.push({ value: option.getAttribute('value'), label: option.innerText });
        }

        return <Fragment>
            <div className="custom-select" onClick={this.showPopup.bind(this)}>
                <div className="select-value">{selected.length < 1 ? placeholder : selected.map(option => option.label).join(', ')}</div>
                <div className="select-icon"><img src="/assets/dashboard/icons/arrow-right.svg"/></div>
            </div>

            {selected.map((option, index) => <input type="hidden" key={index} value={option.value} name={name} />)}

            {this.state.isShowingPopup && <SideSectionComponent onClose={this.closePopup.bind(this)}>
                <div className="side-section-select-list">
                    <PopupSelectComponent options={options}
                                          extractLabel={option => option.label}
                                          extractKey={option => option.value}
                                          updateSelected={this.updateSelected.bind(this)}
                                          multiple={isMultiple} />
                </div>
            </SideSectionComponent>}
        </Fragment>
    }

}

const targets = document.querySelectorAll('.custom-select-target');
for (let i = 0; i < targets.length; i++) {
    const select = targets[i].querySelector('select');
    ReactDOM.render(<SimpleComponent select={select} />, targets[i]);
}
