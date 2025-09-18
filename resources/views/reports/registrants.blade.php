<table>
    <thead>
    <tr>
	    <th>Invoice</th>
        <th>Wristband Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Birthdate</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>Country</th>
        <th>Phone</th>
        <th>Cell</th>
        <th>Email</th>
        <th>Group</th>
        <th>Emergency Contact</th>
        <th>Emergency Number</th>
        <th>Medical Conditions</th>
        <th>Option</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Recumbent</th>
        <th>Towel</th>
        <th>Shower</th>
        <th>Jersey</th>
        <th>Charters</th>
        <th>Discount</th>
        <th>Cost</th>
        <th>Paid</th>
        <th># of RAGBRAIs</th>
        <th>Pay Type</th>
        <th>Signature</th>
        <th>Sign Date</th>
        <th>Registration Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($registrants as $registrant)
        <tr>
            <td>{{ $registrant->invoice }}</td>
            <td>{{ $registrant->wristband }}</td>
            <td>{{ $registrant->fname }}</td>
            <td>{{ $registrant->lname }}</td>
            <td>{{ $registrant->gender }}</td>
            <td>{{ $registrant->dob }}</td>
            <td>{{ $registrant->address }}</td>
            <td>{{ $registrant->city }}</td>
            <td>{{ $registrant->state }}</td>
            <td>{{ $registrant->zip }}</td>
            <td>{{ $registrant->country }}</td>
            <td>{{ $registrant->phone }}</td>
            <td>{{ $registrant->cell }}</td>
            <td>{{ $registrant->email }}</td>
            <td>{{ $registrant->group }}</td>
            <td>{{ $registrant->econtact }}</td>
            <td>{{ $registrant->enumber }}</td>
            <td>{{ $registrant->medical }}</td>
            <td>{{ $registrant->option }}</td>
            <td>{{ $registrant->startdate }}</td>
            <td>{{ $registrant->enddate }}</td>
            <td>{{ $registrant->recumbent }}</td>
            <td>{{ $registrant->towel }}</td>
            <td>{{ $registrant->shower }}</td>
            <td>{{ $registrant->jersey }}</td>
            <td>{{ ($registrant->discount>20)?(4+(($registrant->discount-20)/10)):($registrant->discount/5) }}</td>
            <td>{{ $registrant->discount }}</td>
            <td>{{ $registrant->paid }}</td>
            <td>{{ ($registrant->paytype=='online' && !is_null($registrant->payid) && !empty($registrant->payid))?'Yes':'No' }}</td>
            <td>{{ $registrant->ragbrais }}</td>
            <td>{{ $registrant->paytype }}</td>
            <td>{{ $registrant->signature }}</td>
            <td>{{ date("m/d/Y",strtotime($registrant->signdate)) }}</td>
            <td>{{ date("m/d/Y",strtotime($registrant->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>