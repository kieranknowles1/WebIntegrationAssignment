import { Dialog } from '@headlessui/react'
import PropTypes from 'prop-types'
import React from 'react'

import ContentDetails from './ContentDetails'
import ModalDialog from './ModalDialog'

/** @typedef {import('../api/getContent').Content} Content */

/**
 * ContentItem component
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function ContentItem (props) {
  const [isOpen, setOpen] = React.useState(false)

  return (
      <button className='bg-background-listitem text-foreground-listitem rounded-md p-3 text-left' onClick={() => setOpen(true)}>
        <h2 className='text-center'>{props.title}</h2>
        <p>{props.abstract}</p>
        <p className='text-center font-bold'>{props.type}</p>
        {props.award && <p className='text-center font-bold'>⭐ {props.award}</p>}
        <ModalDialog isOpen={isOpen} setOpen={setOpen}>
          <Dialog.Title className='text-center'>{props.title}</Dialog.Title>
          <ContentDetails contentId={props.id} handleTokenRejected={props.handleTokenRejected} />
        </ModalDialog>
      </button>
  )
}
ContentItem.propTypes = {
  id: PropTypes.number.isRequired,
  title: PropTypes.string.isRequired,
  abstract: PropTypes.string,
  type: PropTypes.string.isRequired,
  award: PropTypes.string,
  handleTokenRejected: PropTypes.func.isRequired
}

export default ContentItem
