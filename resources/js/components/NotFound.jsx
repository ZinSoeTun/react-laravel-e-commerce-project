import React from 'react'
import { Helmet } from "react-helmet"

export default function NotFound() {
  return (
    <div>
     <Helmet>
        <title>Not Found</title>
      </Helmet>
      <div  style={{marginTop: '200px', marginBottom: '120px'}}>
        <h1 className='text-danger text-center'>Page is not found</h1>
        <h1 className='text-danger text-center'>404</h1>
      </div>
    </div>
  )
}
