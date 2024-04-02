import React from 'react'
import  "../../../css/app.css";

export default function ProductDetailRelDesigner({designer}) {
  return (
    <div>
     <h1 className="text-success text-center mb-5" style={{marginTop: '100px'}}>
                        Related <h1 className="text-warning">Designer </h1>
                    </h1>
                        <div className="mt-4">
                        <div className=" text-primary text-center">
                                <h2 className="text-warning">Name</h2>
                                <h2>{designer.name}</h2>
                            </div>
                        </div>
                        <div>
                        <h1 className="text-warning text-center">Description</h1>
                            <p className="text-primary fs-5 ms-lg-4 ms-2">{designer.description}</p>
                        </div>
    </div>
  )
}
