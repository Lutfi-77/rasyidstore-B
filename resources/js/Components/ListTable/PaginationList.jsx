import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-react';
import { Pagination } from '@mantine/core';
import React,{ useContext, useState } from 'react';
import { ListContext } from './ListProvider';

const PaginationList = ({length}) => {

  const {queryTable,query} = useContext(ListContext)
  const paginationHandler = (num) => {

    queryTable({page : num});
  }

  // alert(length);

  return <>
    <Pagination page={query.page} onChange={paginationHandler} total={length} mt="lg" mb="md" />
  </>;
}

export default PaginationList;