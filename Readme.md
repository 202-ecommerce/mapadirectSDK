# MapaDirect SDK

## About

Let the merchants use MapaDirect as a new selling place.  
The SDK contains 8 requests:
1. Auth
2. AddProduct
3. UpdateProduct
4. SetShippingProduct
5. DeleteProduct
6. GetProduct
7. GetTaxes
8. GetCategies

[The documentation][1] of the marketplace API.

## Installation

To install the SDK you need to [Download and install composer][2].

## Requirements

cURL module must be enabled in your server in order for the SDK to work.

## Doc

We use [Stylemark][3] to generate the documentation, go check how it works.  
Documentation files are written in dedicated markdown files placed in `doc/src/`. They need to have the proper header in order to be processed.

```sh
# install dependencies
npm install

# build the documentation
npm run doc-build

# or watch changes (dev server + hot reload)
npm run doc-watch
```

[1]: https://mapadirect.sandbox.wizaplace.com/api/v1/doc/#
[2]: https://getcomposer.org/download
[3]: https://github.com/nextbigsoundinc/stylemark
