import React, {Component} from 'react'
import ReactDOM from 'react-dom'
import PropTypes from 'prop-types'


const target = document.querySelector('.portal-target');

export default class SideSectionComponent extends Component {

    render() {
        return ReactDOM.createPortal(<div className="side-section-wrapper">
            <div className="side-section-container">
                <div className="side-section-header">
                    <div className="header-text">Hello World! :-)</div>
                    <div className="header-close" onClick={this.props.onClose}>
                        <img src="/assets/dashboard/icons/close.svg" className="close-icon"/>
                    </div>
                </div>
                {this.props.children}
            </div>
        </div>, target);
    }

}

SideSectionComponent.propTypes = {
    onClose: PropTypes.func
};
