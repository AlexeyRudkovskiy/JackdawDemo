import React, {Component, Fragment} from 'react'
import PropTypes from 'prop-types'

import SideSectionComponent from '../../general/SideSectionComponent'

export default class PopupSelectComponent extends Component {

    constructor(props) {
        super(props);

        this.state = {
            selectedIds: [  ]
        };
    }

    getItemClasses(option) {
        const {extractKey} = this.props;
        const classes = [ "select-item" ];

        if (this.state.selectedIds.indexOf(extractKey(option)) > -1) {
            classes.push('active');
        }

        return classes.join(' ');
    };

    toggleItem(option) {
        return () => {
            const {extractKey, options, updateSelected} = this.props;
            let {selectedIds} = this.state;
            const optionKey = extractKey(option);

            if (this.props.multiple) {
                if (selectedIds.indexOf(optionKey) > -1) {
                    selectedIds.splice(selectedIds.indexOf(optionKey), 1);
                } else {
                    selectedIds.push(optionKey);
                }
            } else {
                selectedIds = [optionKey];
            }

            this.setState({ selectedIds });

            if (updateSelected !== null) {
                const selected = options.filter(option => selectedIds.indexOf(extractKey(option)) > -1);
                updateSelected.call(window, selected);
            }
        };
    }

    render() {
        const {options, extractLabel, extractKey} = this.props;

        return <Fragment>
            {options.map((option, index) =>
                <div key={index} className={this.getItemClasses(option)} onClick={this.toggleItem(option)}>{extractLabel(option)}</div>)}
        </Fragment>
    }

}

PopupSelectComponent.propTypes = {
    options: PropTypes.array,
    multiple: PropTypes.bool,
    extractLabel: PropTypes.func,
    extractKey: PropTypes.func,
    updateSelected: PropTypes.func
};
