import { Dialog } from '@headlessui/react'
import PropTypes from 'prop-types'
import React from 'react'

import ContentDetails from './ContentDetails'
import ModalDialog from './ModalDialog'

/** @typedef {import('../api/getContent').Content} Content */

/**
 * ContentItem component
 *
 * @param {Content} params
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function ContentItem (params) {
  const [isOpen, setOpen] = React.useState(false)

  return (
      <button className='bg-background-listitem text-foreground-listitem rounded-md p-3 text-left' onClick={() => setOpen(true)}>
        {/** // TODO: Emphasise this and type */}
        <h2 className='text-center'>{params.title}</h2>
        <p>{params.abstract}</p>
        <p className='text-center'>{params.type}</p>
        {params.award && <p className='text-center'>⭐ {params.award}</p>}
        <ModalDialog isOpen={isOpen} setOpen={setOpen}>
          <Dialog.Title className='text-center'>{params.title}</Dialog.Title>
          <ContentDetails contentId={params.id} />
        </ModalDialog>
      </button>
  )
}
ContentItem.propTypes = {
  id: PropTypes.number.isRequired,
  title: PropTypes.string.isRequired,
  abstract: PropTypes.string,
  type: PropTypes.string.isRequired,
  award: PropTypes.string
}

export default ContentItem
